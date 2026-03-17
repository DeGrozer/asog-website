<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIncubateeContactColumns extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('incubatees', [
            'contactName' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'after'      => 'contactDetails',
            ],
            'contactNumber' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'contactName',
            ],
            'contactEmail' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'contactNumber',
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('incubatees', ['contactName', 'contactNumber', 'contactEmail']);
    }
}
