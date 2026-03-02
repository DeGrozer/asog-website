<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class About extends BaseController
{
    public function index(): string
    {
        $settingModel = new SettingModel();

        $data = [
            'title'        => 'About ASOG-TBI',
            'about'        => $settingModel->getByGroup('about'),
            'heroSubtitle' => 'Get to Know Us',
            'heroTitle'    => 'About ASOG-TBI',
            'heroDesc'     => 'Bicol Region\'s Premier AI & Engineering Technology Business Incubator at Camarines Sur Polytechnic Colleges.',
        ];

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('about/index', $data)
            . view('templates/footer');
    }
}