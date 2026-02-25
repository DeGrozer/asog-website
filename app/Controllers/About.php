<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class About extends BaseController
{
    public function index(): string
    {
        $data = ['title' => 'About ASOG-TBI'];
        return view('templates/header', $data)
            . view('about/header')
            . view('landing/about')        
            // . view('templates/map')        
            . view('templates/footer');
    }
}