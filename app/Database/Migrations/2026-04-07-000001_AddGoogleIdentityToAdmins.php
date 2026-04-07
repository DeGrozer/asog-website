<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGoogleIdentityToAdmins extends Migration
{
    public function up(): void
    {
        $fields = [
            'googleEmail' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'email',
            ],
            'googleSub' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'googleEmail',
            ],
        ];

        $this->forge->addColumn('admins', $fields);

        $this->db->query('ALTER TABLE `admins` ADD UNIQUE KEY `admins_googleEmail_unique` (`googleEmail`)');
        $this->db->query('ALTER TABLE `admins` ADD UNIQUE KEY `admins_googleSub_unique` (`googleSub`)');
    }

    public function down(): void
    {
        $this->db->query('ALTER TABLE `admins` DROP INDEX `admins_googleEmail_unique`');
        $this->db->query('ALTER TABLE `admins` DROP INDEX `admins_googleSub_unique`');

        $this->forge->dropColumn('admins', ['googleEmail', 'googleSub']);
    }
}