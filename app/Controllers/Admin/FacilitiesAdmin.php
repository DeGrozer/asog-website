<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class FacilitiesAdmin extends Controller
{
    public function index()
    {
        $data = ['title' => 'Manage Facilities'];
        return view('admin/facilities/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Create Facility'];
        return view('admin/facilities/create', $data);
    }

    public function store()
    {
        // TODO: Save to database
    }

    public function edit($id)
    {
        $data = ['title' => 'Edit Facility', 'id' => $id];
        return view('admin/facilities/edit', $data);
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
