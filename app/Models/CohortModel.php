<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * CohortModel — manages the `cohorts` table.
 * Cohorts exist independently of incubatees so they can
 * appear in navigation and landing pages even when empty.
 */
class CohortModel extends Model
{
    protected $table            = 'cohorts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'createdAt';
    protected $updatedField     = 'updatedAt';

    protected $allowedFields = [
        'name',
        'number',
        'isActive',
    ];

    protected $validationRules = [
        'name'   => 'required|max_length[100]|is_unique[cohorts.name,id,{id}]',
        'number' => 'required|integer|is_unique[cohorts.number,id,{id}]',
    ];

    // ─── Query Helpers ───────────────────────────────────────

    /**
     * All active cohorts, sorted by number ascending.
     */
    public function getActive(): array
    {
        return $this->where('isActive', 1)
                    ->orderBy('number', 'ASC')
                    ->findAll();
    }

    /**
     * Return just the cohort names of active cohorts.
     * e.g. ['Cohort 1', 'Cohort 2']
     */
    public function getActiveNames(): array
    {
        return array_column($this->getActive(), 'name');
    }

    /**
     * Get all cohorts (including inactive), sorted by number.
     */
    public function getAllSorted(): array
    {
        return $this->orderBy('number', 'ASC')->findAll();
    }

    /**
     * Find the next available cohort number.
     */
    public function nextNumber(): int
    {
        $max = $this->selectMax('number')->first();
        return ($max['number'] ?? 0) + 1;
    }
}
