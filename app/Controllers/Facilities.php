<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Facilities extends BaseController
{
    public function index(): string
    {
        $data = ['title' => 'Facilities - ASOG-TBI'];
        return view('templates/header', $data)
            . view('facilities/header')
            . view('landing/facilities')
            . view('templates/map')
            . view('templates/footer');
    }
}
