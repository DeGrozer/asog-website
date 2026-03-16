<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropFounderFieldsFromIncubatees extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('incubatees', ['founderName', 'founderPosition']);
    }

    public function down()
    {
        $this->forge->addColumn('incubatees', [
            'founderName' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'companyName',
            ],
            'founderPosition' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'founderName',
            ],
        ]);
    }
}
