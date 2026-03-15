<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Remove the founderPhoto column from incubatees.
 * Founder is now identified by name only (founderName field).
 */
class DropFounderPhotoFromIncubatees extends Migration
{
    public function up(): void
    {
        $this->db->query('ALTER TABLE incubatees DROP COLUMN IF EXISTS founderPhoto');
    }

    public function down(): void
    {
        $this->forge->addColumn('incubatees', [
            'founderPhoto' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
                'default'    => null,
                'after'      => 'founderPosition',
            ],
        ]);
    }
}
