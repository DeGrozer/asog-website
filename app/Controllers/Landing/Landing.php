<?php

namespace App\Controllers\Landing;
use App\Controllers\BaseController;
class Landing extends BaseController
{
    public function index(): string
    {
        $data = ['title' => 'ASOG-TBI - Home'];

        return view('templates/header', $data)
            . view('landing/body', $data)
            . view('templates/footer');
    }
}