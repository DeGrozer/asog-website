<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLandingSettingsTable extends Migration
{
    public function up(): void
    {
        if ($this->db->tableExists('landing_settings')) {
            return;
        }

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'settingKey' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'settingValue' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'createdAt' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updatedAt' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('settingKey');
        $this->forge->createTable('landing_settings', true);

        $now = date('Y-m-d H:i:s');

        $this->db->table('landing_settings')->insert([
            'settingKey'   => 'landingIncubateesCohortFilter',
            'settingValue' => 'all',
            'createdAt'    => $now,
            'updatedAt'    => $now,
        ]);
    }

    public function down(): void
    {
        $this->forge->dropTable('landing_settings', true);
    }
}
