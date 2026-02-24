<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class News extends BaseController
{
    public function index(): string
    {
        $data = ['title' => 'News & Insights - ASOG-TBI'];
        return view('templates/header', $data)
            . view('news/header')
            . view('landing/news')
            . view('templates/map')
            . view('templates/footer');
    }
}
