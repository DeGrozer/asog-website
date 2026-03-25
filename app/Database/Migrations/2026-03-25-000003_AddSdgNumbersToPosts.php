<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSdgNumbersToPosts extends Migration
{
    public function up(): void
    {
        if (! $this->db->fieldExists('sdgNumbers', 'posts')) {
            $this->forge->addColumn('posts', [
                'sdgNumbers' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 120,
                    'null'       => true,
                    'after'      => 'category',
                ],
            ]);
        }
    }

    public function down(): void
    {
        if ($this->db->fieldExists('sdgNumbers', 'posts')) {
            $this->forge->dropColumn('posts', 'sdgNumbers');
        }
    }
}
