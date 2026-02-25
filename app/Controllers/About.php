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
            'title' => 'About ASOG-TBI',
            'about' => $settingModel->getByGroup('about'),
        ];

        return view('templates/header', $data)
            . view('about/header')
            . view('landing/about', $data)
            . view('templates/footer');
    }
}