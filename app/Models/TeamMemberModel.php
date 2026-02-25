<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * TeamMemberModel — manages the teamMembers table.
 */
class TeamMemberModel extends Model
{
    protected $table            = 'teamMembers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'createdAt';
    protected $updatedField     = 'updatedAt';

    protected $allowedFields = [
        'fullName', 'slug', 'position', 'shortBio',
        'content', 'photoPath', 'email', 'linkedinUrl',
        'sortOrder', 'isPublished',
    ];

    protected $validationRules = [
        'fullName' => 'required|min_length[2]',
        'position' => 'required',
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

    public function generateSlug(string $fullName, ?int $excludeId = null): string
    {
        $slug    = url_title($fullName, '-', true);
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
