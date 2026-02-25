<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;

class News extends BaseController
{
    public function index(): string
    {
        $postModel  = new PostModel();
        $allPosts   = $postModel->getPublished();
        $latestPost = ! empty($allPosts) ? array_shift($allPosts) : null;

        $data = [
            'title'       => 'News & Insights - ASOG-TBI',
            'latestPost'  => $latestPost,
            'posts'       => $allPosts,
        ];

        return view('templates/header', $data)
            . view('news/header')
            . view('news/list', $data)
            . view('templates/footer');
    }

    /**
     * Display a single post by slug.
     */
    public function show(string $slug): string
    {
        $postModel = new PostModel();
        $post = $postModel->getBySlug($slug);

        if (! $post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Post not found.');
        }

        $data = [
            'title'       => esc($post['title']) . ' - ASOG-TBI',
            'post'        => $post,
            'latestPosts' => $postModel->getPublished(3),
        ];

        return view('templates/header', $data)
            . view('news/detail', $data)
            . view('templates/footer');
    }
}