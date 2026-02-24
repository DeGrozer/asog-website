<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Incubatees extends BaseController
{
    public function index(): string
    {
        $data = ['title' => 'Incubatees - ASOG-TBI'];
        return view('templates/header', $data)
            . view('incubatees/header')
            . view('landing/incubatees')
            . view('templates/map')
            . view('templates/footer');
    }
}
