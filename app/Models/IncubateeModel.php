<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * IncubateeModel — manages the incubatees table.
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
        'companyName', 'slug', 'founderName', 'shortDescription',
        'content', 'logoPath', 'websiteUrl', 'cohort',
        'sortOrder', 'isPublished',
    ];

    protected $validationRules = [
        'companyName' => 'required|min_length[2]',
    ];

    // ─── Query Scopes ─────────────────────────────────────

    public function getPublished(int $limit = 0)
    {
        $builder = $this->where('isPublished', 1)
                        ->orderBy('sortOrder', 'ASC');

        return $limit > 0 ? $builder->findAll($limit) : $builder->findAll();
    }

    public function getFeaturedFirst()
    {
        return $this->where('isPublished', 1)
                    ->orderBy('sortOrder', 'ASC')
                    ->first();
    }

    public function getBySlug(string $slug)
    {
        return $this->where('slug', $slug)
                    ->where('isPublished', 1)
                    ->first();
    }

    public function generateSlug(string $companyName, ?int $excludeId = null): string
    {
        $slug    = url_title($companyName, '-', true);
        $builder = $this->where('slug', $slug);

        if ($excludeId !== null) {
            $builder->where('id !=', $excludeId);
        }

        if ($builder->countAllResults() > 0) {
            $slug .= '-' . time();
        }

        return $slug;
    }
}
