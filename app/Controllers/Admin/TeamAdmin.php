<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class TeamAdmin extends Controller
{
    public function index()
    {
        $data = ['title' => 'Manage Team Members'];
        return view('admin/team/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Add Team Member'];
        return view('admin/team/create', $data);
    }

    public function store()
    {
        // TODO: Save to database
    }

    public function edit($id)
    {
        $data = ['title' => 'Edit Team Member', 'id' => $id];
        return view('admin/team/edit', $data);
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
