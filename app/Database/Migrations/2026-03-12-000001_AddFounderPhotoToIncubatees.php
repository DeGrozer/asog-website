<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Adds a founderPhoto column to the incubatees table
 * for storing the path to the founder's profile picture.
 */
class AddFounderPhotoToIncubatees extends Migration
{
    public function up()
    {
        $this->forge->addColumn('incubatees', [
            'founderPhoto' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
                'after'      => 'founderName',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('incubatees', 'founderPhoto');
    }
}
