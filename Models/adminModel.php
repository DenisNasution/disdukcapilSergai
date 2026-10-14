<?php

namespace App\Models;

use CodeIgniter\Model;

class adminModel extends Model
{
    protected $table = 'tb_admin';
    protected $primaryKey = 'admin_id';
    protected $allowedFields = [
        'admin_username',
        'admin_password',
        'admin_role',
        'admin_last_login',
        'admin_login_attempts',
        'admin_locked_until'
    ];
    protected $useTimestamps = false;

    private const MAX_ATTEMPTS = 5;
    private const LOCKOUT_MINUTES = 15;

    public function findByUsername(string $username)
    {
        return $this->where('admin_username', $username)->first();
    }

    public function register(array $data)
    {
        $data['admin_password'] = password_hash($data['admin_password'], PASSWORD_BCRYPT);
        return $this->insert($data);
    }

    public function attemptLogin(string $username, string $password)
    {
        $admin = $this->findByUsername($username);

            if (!$admin) {
            return ['success' => false, 'reason' => 'invalid'];
        }

            if ($admin['admin_locked_until'] !== null) {
            $lockedUntil = strtotime($admin['admin_locked_until']);
            if (time() < $lockedUntil) {
                $remaining = ceil(($lockedUntil - time()) / 60);
                return ['success' => false, 'reason' => 'locked', 'remaining' => $remaining];
            } else {
                            $this->update($admin['admin_id'], [
                    'admin_locked_until' => null,
                    'admin_login_attempts' => 0
                ]);
                $admin['admin_login_attempts'] = 0;
                $admin['admin_locked_until'] = null;
            }
        }

            if (password_verify($password, $admin['admin_password'])) {
                    $this->update($admin['admin_id'], [
                'admin_login_attempts' => 0,
                'admin_locked_until' => null,
                'admin_last_login' => date('Y-m-d H:i:s')
            ]);
            return ['success' => true, 'admin' => $admin];
        }

            $newAttempts = $admin['admin_login_attempts'] + 1;
        $updateData = ['admin_login_attempts' => $newAttempts];

        if ($newAttempts >= self::MAX_ATTEMPTS) {
            $updateData['admin_locked_until'] = date('Y-m-d H:i:s', strtotime('+' . self::LOCKOUT_MINUTES . ' minutes'));
        }

        $this->update($admin['admin_id'], $updateData);

        return [
            'success' => false,
            'reason' => 'invalid',
            'attempts_left' => self::MAX_ATTEMPTS - $newAttempts
        ];
    }
}