<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'user',
        'role',
        'password',
        'name',
        'email',
        'active',
        'activation_token',
        'reset_token',
        'reset_token_expires_at',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function validateUser(string $username, string $password): ?array
    {
        // Busca usuario activo
        $user = $this->where('user', $username)
            ->where('active', 1)
            ->first();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }
}