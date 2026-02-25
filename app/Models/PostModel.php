<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * PostModel — handles all CRUD operations for the `posts` table.
 *
 * Column naming follows camelCase convention.
 */
class PostModel extends Model
{
    protected $table         = 'posts';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';

    protected $allowedFields = [
        'title',
        'slug',
        'shortDescription',
        'content',
        'category',
        'imagePath',
        'isPublished',
        'isFeatured',
        'authorName',
        'publishedAt',
    ];

    protected $returnType = 'array';

    // ──────────────────────────────────────────────────────────────
    // Validation
    // ──────────────────────────────────────────────────────────────
    protected $validationRules = [
        'title'            => 'required|min_length[3]|max_length[255]',
        'shortDescription' => 'permit_empty|max_length[500]',
        'content'          => 'permit_empty',
        'category'         => 'required|in_list[news,events,features]',
    ];

    protected $validationMessages = [
        'title' => [
            'required'   => 'A post title is required.',
            'min_length' => 'Title must be at least 3 characters.',
        ],
        'category' => [
            'in_list' => 'Category must be one of: news, events, features.',
        ],
    ];

    // ──────────────────────────────────────────────────────────────
    // Scopes / Query helpers
    // ──────────────────────────────────────────────────────────────

    /**
     * Return only published posts, newest first.
     */
    public function getPublished(int $limit = 0)
    {
        $builder = $this->where('isPublished', 1)
                        ->orderBy('publishedAt', 'DESC');

        return $limit > 0 ? $builder->findAll($limit) : $builder->findAll();
    }

    /**
     * Return published posts filtered by category.
     */
    public function getByCategory(string $category, int $limit = 0)
    {
        $builder = $this->where('isPublished', 1)
                        ->where('category', $category)
                        ->orderBy('publishedAt', 'DESC');

        return $limit > 0 ? $builder->findAll($limit) : $builder->findAll();
    }

    /**
     * Return the single featured post (latest if multiple are flagged).
     */
    public function getFeatured(): ?array
    {
        return $this->where('isPublished', 1)
                    ->where('isFeatured', 1)
                    ->orderBy('publishedAt', 'DESC')
                    ->first();
    }

    /**
     * Find a post by its slug.
     */
    public function getBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)
                    ->where('isPublished', 1)
                    ->first();
    }

    /**
     * Generate a URL-safe slug from the title, ensuring uniqueness.
     */
    public function generateSlug(string $title, ?int $excludeId = null): string
    {
        $slug = url_title($title, '-', true);
        $existing = $this->where('slug', $slug);

        if ($excludeId !== null) {
            $existing->where('id !=', $excludeId);
        }

        if ($existing->countAllResults() > 0) {
            $slug .= '-' . time();
        }

        return $slug;
    }
}
