<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIncubateeApplicationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'startupName' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'startupDescription' => [
                'type' => 'TEXT',
            ],
            'mainRisk' => [
                'type'   => 'TEXT',
                'null'   => true,
            ],
            'shortTermGoals' => [
                'type'   => 'TEXT',
                'null'   => true,
            ],
            'teamCvPath' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'videoPresentationLink' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
            ],
            'applicantName' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'applicantEmail' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'contactNumber' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'applicationStatus' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'reviewed', 'accepted', 'rejected'],
                'default'    => 'pending',
            ],
            'createdAt' => [
                'type'    => 'DATETIME',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updatedAt' => [
                'type'    => 'DATETIME',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('applicantEmail');
        $this->forge->addKey('applicationStatus');
        $this->forge->addKey('createdAt');

        $this->forge->createTable('incubatee_applications');
    }

    public function down()
    {
        $this->forge->dropTable('incubatee_applications');
    }
}
