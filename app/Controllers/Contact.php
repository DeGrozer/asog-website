<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Contact extends BaseController
{
    public function index(): string
    {
        $data = ['title' => 'Contact - ASOG-TBI'];
        return view('templates/header', $data)
            . view('contact/header')
            . view('landing/contact')
            . view('templates/map')
            . view('templates/footer');
    }
}
