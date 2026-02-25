<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Programs extends BaseController
{
    public function index(): string
    {
        $data = ['title' => 'Programs & Services - ASOG-TBI'];
        return view('templates/header', $data)
            . view('programs/header')
            . view('landing/programs')
            // . view('templates/map')
            . view('templates/footer');
    }
}