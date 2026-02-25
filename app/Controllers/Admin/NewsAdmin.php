<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class NewsAdmin extends Controller
{
    public function index()
    {
        $data = ['title' => 'Manage News & Insights'];
        return view('admin/news/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Create News Article'];
        return view('admin/news/create', $data);
    }

    public function store()
    {
        // TODO: Save to database
    }

    public function edit($id)
    {
        $data = ['title' => 'Edit News Article', 'id' => $id];
        return view('admin/news/edit', $data);
    }

    public function update($id)
    {
        // TODO: Update database
    }

    public function delete($id)
    {
        // TODO: Delete from database
    }
}
