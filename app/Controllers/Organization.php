<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Organization extends BaseController
{
    public function index(): string
    {
        $data = ['title' => 'Organization - ASOG-TBI'];
        return view('templates/header', $data)
            . view('organization/header')
            . view('landing/organization')
            // . view('templates/map')
            . view('templates/footer');
    }
}