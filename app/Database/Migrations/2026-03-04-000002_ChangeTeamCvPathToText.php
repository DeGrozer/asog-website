<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Changes teamCvPath from VARCHAR(255) to TEXT so that it can hold
 * comma-separated paths for up to 10 (or more) uploaded CV files.
 */
class ChangeTeamCvPathToText extends Migration
{
    public function up(): void
    {
        $this->forge->modifyColumn('incubatee_applications', [
            'teamCvPath' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->modifyColumn('incubatee_applications', [
            'teamCvPath' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
        ]);
    }
}
