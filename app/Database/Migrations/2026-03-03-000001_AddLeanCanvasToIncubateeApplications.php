<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLeanCanvasToIncubateeApplications extends Migration
{
    public function up()
    {
        $this->forge->addColumn('incubatee_applications', [
            'leanCanvasPath' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
                'default'    => null,
                'after'      => 'teamCvPath',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('incubatee_applications', 'leanCanvasPath');
    }
}
