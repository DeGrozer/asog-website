<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFounderPositionToIncubatees extends Migration
{
    public function up()
    {
        $this->forge->addColumn('incubatees', [
            'founderPosition' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'after'      => 'founderName',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('incubatees', 'founderPosition');
    }
}
