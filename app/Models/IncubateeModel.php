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
     * Daily-rotating featured incubatee.
     * Uses the current day-of-year modulo the number of published incubatees
     * so a different one is highlighted each day.
     */
    public function getFeatured(): ?array
    {
        $published = $this->where('isPublished', 1)
                          ->orderBy('sortOrder', 'ASC')
                          ->findAll();

        if (empty($published)) {
            return null;
        }

        $dayOfYear = (int) date('z'); // 0–365
        $index     = $dayOfYear % count($published);

        return $published[$index];
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

    /**
     * Generate a unique slug from the company name.
     */
    public function generateSlug(string $companyName, ?int $excludeId = null): string
    {
        $base = url_title($companyName, '-', true);
        $slug = $base;
        $i    = 1;

        while (true) {
            $builder = $this->where('slug', $slug);
            if ($excludeId !== null) {
                $builder->where('id !=', $excludeId);
            }
            if ($builder->countAllResults(false) === 0) {
                break;
            }
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
