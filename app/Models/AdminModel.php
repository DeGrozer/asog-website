<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * AdminModel — handles authentication and admin user management.
 *
 * Passwords are hashed with bcrypt via password_hash() / password_verify().
 * Column naming follows camelCase convention.
 */
class AdminModel extends Model
{
    protected $table         = 'admins';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';

    protected $allowedFields = [
        'fullName',
        'email',
        'password',
        'role',
        'isActive',
        'lastLoginAt',
    ];

    protected $returnType = 'array';

    // ──────────────────────────────────────────────────────────────
    // Validation
    // ──────────────────────────────────────────────────────────────
    protected $validationRules = [
        'fullName' => 'required|min_length[2]|max_length[150]',
        'email'    => 'required|valid_email|max_length[255]',
        'password' => 'required|min_length[8]',
    ];

    protected $validationMessages = [
        'fullName' => [
            'required' => 'Full name is required.',
        ],
        'email' => [
            'required'    => 'Email address is required.',
            'valid_email' => 'Please enter a valid email address.',
        ],
        'password' => [
            'required'   => 'Password is required.',
            'min_length' => 'Password must be at least 8 characters.',
        ],
    ];

    // ──────────────────────────────────────────────────────────────
    // Callbacks — auto-hash password before insert/update
    // ──────────────────────────────────────────────────────────────
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash(
                $data['data']['password'],
                PASSWORD_BCRYPT
            );
        }

        return $data;
    }

    // ──────────────────────────────────────────────────────────────
    // Auth helpers
    // ──────────────────────────────────────────────────────────────

    /**
     * Attempt login with email + plain-text password.
     *
     * Returns the admin row on success, null on failure.
     */
    public function attempt(string $email, string $password): ?array
    {
        $admin = $this->where('email', $email)
                      ->where('isActive', 1)
                      ->first();

        if ($admin === null) {
            return null;
        }

        if (! password_verify($password, $admin['password'])) {
            return null;
        }

        // Stamp last login
        $this->update($admin['id'], [
            'lastLoginAt' => date('Y-m-d H:i:s'),
        ]);

        return $admin;
    }

    /**
     * Find an admin by email.
     */
    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }
}
