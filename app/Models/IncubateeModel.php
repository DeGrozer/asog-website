<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * IncubateeModel — manages the `incubatees` showcase table.
 */
class IncubateeModel extends Model
{
    protected $table            = 'incubatees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'createdAt';
    protected $updatedField     = 'updatedAt';

    protected $allowedFields = [
        'companyName',
        'slug',
        'founderName',
        'shortDescription',
        'content',
        'logoPath',
        'websiteUrl',
        'cohort',
        'sortOrder',
        'isPublished',
    ];

    // ─── Query Helpers ───────────────────────────────────────

    /**
     * All published incubatees, ordered by sortOrder then newest.
     */
    public function getPublished(): array
    {
        return $this->where('isPublished', 1)
                    ->orderBy('sortOrder', 'ASC')
                    ->orderBy('createdAt', 'DESC')
                    ->findAll();
    }

    /**
     * First published incubatee (featured spotlight).
     */
    public function getFeatured(): ?array
    {
        return $this->where('isPublished', 1)
                    ->orderBy('sortOrder', 'ASC')
                    ->first();
    }

    /**
     * Find by slug.
     */
    public function getBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)
                    ->where('isPublished', 1)
                    ->first();
    }

    /**
     * Grouped by cohort for display.
     */
    public function getPublishedGroupedByCohort(): array
    {
        $all = $this->getPublished();
        $grouped = [];
        foreach ($all as $inc) {
            $cohort = $inc['cohort'] ?: 'Other';
            $grouped[$cohort][] = $inc;
        }
        return $grouped;
    }
}
