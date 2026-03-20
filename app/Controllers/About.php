<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class About extends BaseController
{
    public function index(): string
    {
        $data = [
            'title'        => 'About ASOG-TBI',
            'heroSubtitle' => 'Get to Know Us',
            'heroTitle'    => 'About ASOG-TBI',
            'heroDesc'     => 'Bicol Region\'s Premier AI & Engineering Technology Business Incubator at Camarines Sur Polytechnic Colleges.',
        ];

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('about/index', $data)
            . view('templates/footer');
    }

    public function logo(): string
    {
        $data = [
            'title'        => 'ASOG-TBI Logo',
            'heroSubtitle' => 'Brand Identity',
            'heroTitle'    => 'ASOG-TBI Logo',
            'heroDesc'     => 'Official logo variants and visual identity of the ASOG Technology Business Incubator.',
        ];

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('about/logo', $data)
            . view('templates/footer');
    }
}