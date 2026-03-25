<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSdgNumbersToIncubatees extends Migration
{
    public function up(): void
    {
        if (! $this->db->fieldExists('sdgNumbers', 'incubatees')) {
            $this->forge->addColumn('incubatees', [
                'sdgNumbers' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 120,
                    'null'       => true,
                    'after'      => 'content',
                ],
            ]);
        }
    }

    public function down(): void
    {
        if ($this->db->fieldExists('sdgNumbers', 'incubatees')) {
            $this->forge->dropColumn('incubatees', 'sdgNumbers');
        }
    }
}
