<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    /**
     * Generate a unique alphanumeric ID
     * 
     * @param int    $length    Number of characters (default: 7)
     * @param string $charset   Character set to use
     * @param string $column    Column name to check for uniqueness
     * @return string
     */
    public function generateId(int $length = 20, string $charset = 'alphanumeric', string $column = null): string
    {
        $column = $column ?? $this->primaryKey;
        
        $charSets = [
            'alphanumeric' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',
            'uppercase'    => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'lowercase'    => '0123456789abcdefghijklmnopqrstuvwxyz',
            'numeric'      => '0123456789',
        ];
        
        $chars = $charSets[$charset] ?? $charSets['lowercase'];
        $maxIndex = strlen($chars) - 1;
        
        do {
            $id = '';
            for ($i = 0; $i < $length; $i++) {
                $id .= $chars[random_int(0, $maxIndex)];
            }
        } while ($this->where($column, $id)->first());
        
        return $id;
    }
}