<?php

namespace App\Models;

use CodeIgniter\Model;

/**  
 * PostModel — handles CRUD operations for the `posts` table.
**/
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

    // ─── Validation ───────────────────────────────────────────
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

    // ─── Query Helpers ────────────────────────────────────────

    /**  
     * Return summary counts for the dashboard.
    **/
    public function getCounts(): array
    {
        $total     = $this->countAllResults();
        $published = $this->where('isPublished', 1)->countAllResults();
        $drafts    = $this->where('isPublished', 0)->countAllResults();
        $featured  = $this->where('isFeatured', 1)->countAllResults();

        return compact('total', 'published', 'drafts', 'featured');
    }

    /**  
     * Return only published posts, newest first.
    **/
    public function getPublished(int $limit = 0)
    {
        $builder = $this->where('isPublished', 1)
                        ->orderBy('publishedAt', 'DESC');

        return $limit > 0 ? $builder->findAll($limit) : $builder->findAll();
    }

    /**  
     * Return published posts filtered by category.
    **/
    public function getByCategory(string $category, int $limit = 0)
    {
        $builder = $this->where('isPublished', 1)
                        ->where('category', $category)
                        ->orderBy('publishedAt', 'DESC');

        return $limit > 0 ? $builder->findAll($limit) : $builder->findAll();
    }

    /**  
     * Return the single featured post (latest if multiple are flagged).
    **/
    public function getFeatured(): ?array
    {
        return $this->where('isPublished', 1)
                    ->where('isFeatured', 1)
                    ->orderBy('publishedAt', 'DESC')
                    ->first();
    }

    /**  
     * Return up to $limit published+featured posts that have a cover image.
     * Used by the landing-page hero slideshow.
    **/
    public function getFeaturedSlides(int $limit = 5): array
    {
        return $this->where('isPublished', 1)
                    ->where('isFeatured', 1)
                    ->where('imagePath !=', '')
                    ->where('imagePath IS NOT NULL', null, false)
                    ->orderBy('publishedAt', 'DESC')
                    ->findAll($limit);
    }

    /**  
     * Return the latest published posts for the hero slideshow.
    **/
    public function getHeroSlides(int $limit = 5): array
    {
        return $this->where('isPublished', 1)
                    ->orderBy('publishedAt', 'DESC')
                    ->findAll($limit);
    }

    /**  
     * Find a post by its slug.
    **/
    public function getBySlug(string $slug): ?array
    {
        return $this->where('slug', $slug)
                    ->where('isPublished', 1)
                    ->first();
    }

    /**  
     * Clear the featured flag on ALL posts (so only one can be featured).
     * Optionally exclude a specific post ID.
    **/
    public function clearFeatured(?int $excludeId = null): void
    {
        $builder = $this->builder();
        if ($excludeId !== null) {
            $builder->where('id !=', $excludeId);
        }
        $builder->set('isFeatured', 0)->update();
    }

    /**  
     * Generate a URL-safe slug from the title, ensuring uniqueness.
    **/
    public function generateSlug(string $title, ?int $excludeId = null): string
    {
        $slug = url_title($title, '-', true);
        // Use an independent builder so we don't pollute the model's
        // internal query state (which would break a subsequent update()).
        $builder = $this->db->table($this->table)->where('slug', $slug);

        if ($excludeId !== null) {
            $builder->where('id !=', $excludeId);
        }

        if ($builder->countAllResults() > 0) {
            $slug .= '-' . time();
        }

        return $slug;
    }
}
