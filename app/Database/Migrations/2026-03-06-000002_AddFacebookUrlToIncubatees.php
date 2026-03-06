<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFacebookUrlToIncubatees extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('incubatees', [
            'facebookUrl' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
                'after'      => 'websiteUrl',
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('incubatees', 'facebookUrl');
    }
}
