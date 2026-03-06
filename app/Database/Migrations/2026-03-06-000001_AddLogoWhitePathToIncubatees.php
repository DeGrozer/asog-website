<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLogoWhitePathToIncubatees extends Migration
{
    public function up()
    {
        $this->forge->addColumn('incubatees', [
            'logoWhitePath' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
                'after'      => 'logoPath',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('incubatees', 'logoWhitePath');
    }
}
