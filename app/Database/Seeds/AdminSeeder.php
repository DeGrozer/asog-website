<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeds the default admin account.
 *
 * Run with:  php spark db:seed AdminSeeder
 */
class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'fullName'  => 'ASOG Administrator',
            'email'     => 'admin@asog.local',
            'password'  => password_hash('AsogAdmin@2026', PASSWORD_BCRYPT),
            'role'      => 'superadmin',
            'isActive'  => 1,
            'createdAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s'),
        ];

        // Avoid duplicate if seeder runs twice
        $existing = $this->db->table('admins')
                             ->where('email', $data['email'])
                             ->countAllResults();

        if ($existing === 0) {
            $this->db->table('admins')->insert($data);
            echo "✔ Default admin account created (admin@asog.local)\n";
        } else {
            echo "⚠ Admin account already exists — skipped.\n";
        }
    }
}
