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
            'heroDesc'     => 'Empowering startups and MSMEs with AI-driven engineering solutions for food value chain management — from the heart of the Bicol Region.',
        ];

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('about/index', $data)
            . view('templates/footer');
    }
}