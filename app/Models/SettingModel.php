<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * SettingModel — key-value store for site-wide settings.
 *
 * Groups: about, hero, cta, contact, general
 */
class SettingModel extends Model
{
    protected $table            = 'siteSettings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'createdAt';
    protected $updatedField     = 'updatedAt';

    protected $allowedFields = [
        'settingKey', 'settingValue', 'settingGroup',
    ];

    // ─── Accessors ─────────────────────────────────────────

    /**
     * Get a single setting value by key.
     */
    public function getSetting(string $key, ?string $default = null): ?string
    {
        $row = $this->where('settingKey', $key)->first();
        return $row ? $row['settingValue'] : $default;
    }

    /**
     * Upsert a setting value.
     */
    public function setSetting(string $key, ?string $value, string $group = 'general'): bool
    {
        $existing = $this->where('settingKey', $key)->first();

        if ($existing) {
            return $this->update($existing['id'], ['settingValue' => $value]);
        }

        return (bool) $this->insert([
            'settingKey'   => $key,
            'settingValue' => $value,
            'settingGroup' => $group,
        ]);
    }

    /**
     * Get all settings in a group as key => value array.
     */
    public function getByGroup(string $group): array
    {
        $rows     = $this->where('settingGroup', $group)->findAll();
        $settings = [];

        foreach ($rows as $row) {
            $settings[$row['settingKey']] = $row['settingValue'];
        }

        return $settings;
    }

    /**
     * Get every setting as key => value array.
     */
    public function getAll(): array
    {
        $rows     = $this->findAll();
        $settings = [];

        foreach ($rows as $row) {
            $settings[$row['settingKey']] = $row['settingValue'];
        }

        return $settings;
    }
}
