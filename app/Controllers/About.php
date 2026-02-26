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
            'heroBg'       => 'bg-light',
            'heroSubtitle' => 'About ASOG-TBI',
            'heroTitle'    => 'About Us',
            'heroDesc'     => 'ASOG Technology Business Incubator (TBI) supports startups and MSMEs with facilities, mentorship, and services that accelerate innovation and commercialization.',
        ];

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('landing/about', $data)
            . view('templates/footer');
    }
}