<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    /**
     * Render the admin dashboard overview.
     *
     * Aggregates post, application, and message metrics for display.
     */
     
    public function index()
    {
        $postCounts = $this->postModel->getCounts();
        $appCounts  = $this->applicationModel->getCounts();

        $data = [
            'pageTitle'       => 'Dashboard',
            'activePage'      => 'dashboard',
            'totalPosts'      => $postCounts['total'],
            'publishedPosts'  => $postCounts['published'],
            'draftPosts'      => $postCounts['drafts'],
            'featuredPosts'   => $postCounts['featured'],
            'recentPosts'     => $this->postModel->orderBy('createdAt', 'DESC')->findAll(5),
            'totalApps'       => $appCounts['total'],
            'pendingApps'     => $appCounts['pending'],
            'acceptedApps'    => $appCounts['accepted'],
            'rejectedApps'    => $appCounts['rejected'],
            'recentApps'      => $this->applicationModel->getAll(5),
            'unreadMessages'  => $this->contactModel->countUnread(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/dashboard', $data)
             . view('admin/layout/footer');
    }
}