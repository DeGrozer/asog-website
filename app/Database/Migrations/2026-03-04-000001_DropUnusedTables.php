<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: Drop unused tables whose content is now hardcoded in views.
 *
 * Tables removed: facilities, incubatees, programs, sitesettings, teammembers.
 * Retained: admins, posts, incubatee_applications, migrations.
 */
class DropUnusedTables extends Migration
{
    /**
     * Tables to remove (order doesn't matter — no FK relationships between them).
     */
    private array $tables = [
        'facilities',
        'incubatees',
        'programs',
        'sitesettings',
        'teammembers',
    ];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            $this->forge->dropTable($table, true);  // true = IF EXISTS
        }
    }

    public function down(): void
    {
        // ── facilities ──
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'shortDescription' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'content'          => ['type' => 'TEXT', 'null' => true],
            'imagePath'        => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'sortOrder'        => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
            'isPublished'      => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'createdAt'        => ['type' => 'DATETIME', 'null' => true],
            'updatedAt'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug', 'idx_facilities_slug');
        $this->forge->createTable('facilities', true);

        // ── incubatees ──
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'companyName'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'founderName'      => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'shortDescription' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'content'          => ['type' => 'TEXT', 'null' => true],
            'logoPath'         => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'websiteUrl'       => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'cohort'           => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'sortOrder'        => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
            'isPublished'      => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'createdAt'        => ['type' => 'DATETIME', 'null' => true],
            'updatedAt'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug', 'idx_incubatees_slug');
        $this->forge->createTable('incubatees', true);

        // ── programs ──
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'title'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'shortDescription' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'content'          => ['type' => 'TEXT', 'null' => true],
            'iconSvg'          => ['type' => 'TEXT', 'null' => true],
            'imagePath'        => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'sortOrder'        => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
            'isPublished'      => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'createdAt'        => ['type' => 'DATETIME', 'null' => true],
            'updatedAt'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug', 'idx_programs_slug');
        $this->forge->createTable('programs', true);

        // ── sitesettings ──
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'settingKey'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'settingValue' => ['type' => 'TEXT', 'null' => true],
            'settingGroup' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'general'],
            'createdAt'    => ['type' => 'DATETIME', 'null' => true],
            'updatedAt'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('settingKey', 'idx_settings_key');
        $this->forge->createTable('sitesettings', true);

        // ── teammembers ──
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'fullName'    => ['type' => 'VARCHAR', 'constraint' => 150],
            'slug'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'position'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'shortBio'    => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'content'     => ['type' => 'TEXT', 'null' => true],
            'photoPath'   => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'email'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'linkedinUrl' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'sortOrder'   => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
            'isPublished' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'createdAt'   => ['type' => 'DATETIME', 'null' => true],
            'updatedAt'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug', 'idx_team_slug');
        $this->forge->createTable('teammembers', true);
    }
}
