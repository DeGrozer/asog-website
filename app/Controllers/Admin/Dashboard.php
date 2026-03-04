<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $allPosts = $this->postModel->findAll();
        $published = array_filter($allPosts, fn($p) => $p['isPublished'] == 1);
        $drafts    = array_filter($allPosts, fn($p) => $p['isPublished'] == 0);
        $featured  = array_filter($allPosts, fn($p) => $p['isFeatured'] == 1);

        $allApps     = $this->applicationModel->getAll();
        $pendingApps = array_filter($allApps, fn($a) => $a['applicationStatus'] === 'pending');

        $data = [
            'pageTitle'      => 'Dashboard',
            'activePage'     => 'dashboard',
            'totalPosts'     => count($allPosts),
            'publishedPosts' => count($published),
            'draftPosts'     => count($drafts),
            'featuredPosts'  => count($featured),
            'recentPosts'    => $this->postModel->orderBy('createdAt', 'DESC')->findAll(5),
            'totalApps'      => count($allApps),
            'pendingApps'    => count($pendingApps),
            'acceptedApps'   => count(array_filter($allApps, fn($a) => $a['applicationStatus'] === 'accepted')),
            'rejectedApps'   => count(array_filter($allApps, fn($a) => $a['applicationStatus'] === 'rejected')),
            'recentApps'     => array_slice($allApps, 0, 5),
        ];

        return view('admin/layout/header', $data)
             . view('admin/dashboard', $data)
             . view('admin/layout/footer');
    }
}
