<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ProgramModel — manages the programs table.
 */
class ProgramModel extends Model
{
    protected $table            = 'programs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'createdAt';
    protected $updatedField     = 'updatedAt';

    protected $allowedFields = [
        'title', 'slug', 'shortDescription', 'content',
        'iconSvg', 'imagePath', 'sortOrder', 'isPublished',
    ];

    protected $validationRules = [
        'title' => 'required|min_length[3]',
    ];

    // ─── Query Scopes ─────────────────────────────────────

    public function getPublished(int $limit = 0)
    {
        $builder = $this->where('isPublished', 1)
                        ->orderBy('sortOrder', 'ASC');

        return $limit > 0 ? $builder->findAll($limit) : $builder->findAll();
    }

    public function getBySlug(string $slug)
    {
        return $this->where('slug', $slug)
                    ->where('isPublished', 1)
                    ->first();
    }

    public function generateSlug(string $title, ?int $excludeId = null): string
    {
        $slug    = url_title($title, '-', true);
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
