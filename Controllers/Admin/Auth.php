<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\adminModel;

class Auth extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new adminModel();
    }

    public function login()
    {
        if (session()->get('is_admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/auth/login');
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'password' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $result = $this->adminModel->attemptLogin($username, $password);

        if ($result['success']) {
            $admin = $result['admin'];

            session()->set([
                'is_admin_logged_in' => true,
                'admin_id'           => $admin['admin_id'],
                'admin_username'     => $admin['admin_username'],
                'admin_name'         => $admin['admin_name'],
                'admin_role'         => $admin['admin_role'],
                'last_regeneration'  => time(),
            ]);

            session()->regenerate();

            return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang, ' . $admin['admin_name'] . '!');
        }

        $message = 'Username atau password salah.';
        if (isset($result['reason']) && $result['reason'] === 'locked') {
            $message = 'Akun terkunci. Coba lagi dalam ' . $result['remaining'] . ' menit.';
        } elseif (isset($result['attempts_left'])) {
            $message = 'Username atau password salah. Sisa percobaan: ' . $result['attempts_left'];
        }

        return redirect()->back()->withInput()->with('error', $message);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login')->with('success', 'Anda telah logout.');
    }
}