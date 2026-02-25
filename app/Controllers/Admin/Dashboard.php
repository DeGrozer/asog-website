<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\PostModel;

class Dashboard extends Controller
{
    public function index()
    {
        helper(['toast']);
        $postModel = new PostModel();

        $allPosts = $postModel->findAll();
        $published = array_filter($allPosts, fn($p) => $p['isPublished'] == 1);
        $drafts    = array_filter($allPosts, fn($p) => $p['isPublished'] == 0);
        $featured  = array_filter($allPosts, fn($p) => $p['isFeatured'] == 1);

        $data = [
            'pageTitle'      => 'Dashboard',
            'activePage'     => 'dashboard',
            'totalPosts'     => count($allPosts),
            'publishedPosts' => count($published),
            'draftPosts'     => count($drafts),
            'featuredPosts'  => count($featured),
            'recentPosts'    => $postModel->orderBy('createdAt', 'DESC')->findAll(5),
        ];

        return view('admin/layout/header', $data)
             . view('admin/dashboard', $data)
             . view('admin/layout/footer');
    }
}
