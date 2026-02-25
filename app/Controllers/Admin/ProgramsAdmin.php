<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class ProgramsAdmin extends Controller
{
    public function index()
    {
        $data = ['title' => 'Manage Programs & Services'];
        return view('admin/programs/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Create Program'];
        return view('admin/programs/create', $data);
    }

    public function store()
    {
        // TODO: Save to database
    }

    public function edit($id)
    {
        $data = ['title' => 'Edit Program', 'id' => $id];
        return view('admin/programs/edit', $data);
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
