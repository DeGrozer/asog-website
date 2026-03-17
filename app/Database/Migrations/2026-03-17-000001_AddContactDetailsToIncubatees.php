<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddContactDetailsToIncubatees extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('incubatees', [
            'contactDetails' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'facebookUrl',
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('incubatees', 'contactDetails');
    }
}
