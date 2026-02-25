<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class IncubateesAdmin extends Controller
{
    public function index()
    {
        $data = ['title' => 'Manage Incubatees'];
        return view('admin/incubatees/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Add Incubatee'];
        return view('admin/incubatees/create', $data);
    }

    public function store()
    {
        // TODO: Save to database
    }

    public function edit($id)
    {
        $data = ['title' => 'Edit Incubatee', 'id' => $id];
        return view('admin/incubatees/edit', $data);
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
