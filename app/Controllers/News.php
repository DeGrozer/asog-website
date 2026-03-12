<?php

namespace App\Controllers;

class News extends BaseController
{
    public function index(): string
    {
        $category = $this->request->getGet('category');
        $validCategories = ['news', 'features', 'opinions'];

        if ($category && in_array($category, $validCategories)) {
            $allPosts = $this->postModel->getByCategory($category);
            $activeCategory = $category;
        } else {
            $allPosts = $this->postModel->getPublished();
            $activeCategory = '';
        }

        $latestPost = ! empty($allPosts) ? array_shift($allPosts) : null;

        $data = [
            'title'           => 'News & Insights - ASOG-TBI',
            'latestPost'      => $latestPost,
            'posts'           => $allPosts,
            'activeCategory'  => $activeCategory,
        ];

        $data['heroSubtitle'] = 'Stay Updated';
        $data['heroTitle']    = 'News & Insights';
        $data['heroDesc']     = 'The latest events, features, and stories from ASOG Technology Business Incubator.';

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('news/list', $data)
            . view('templates/footer');
    }

    /**
     * Display a single post by slug.
     */
    public function show(string $slug): string
    {
        $post = $this->postModel->getBySlug($slug);

        if (! $post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Post not found.');
        }

        $data = [
            'title'       => esc($post['title']) . ' - ASOG-TBI',
            'post'        => $post,
            'latestPosts' => $this->postModel->getPublished(3),
        ];

        return view('templates/header', $data)
            . view('news/detail', $data)
            . view('templates/footer');
    }
}