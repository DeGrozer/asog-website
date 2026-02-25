<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\ProgramModel;
use App\Models\FacilityModel;
use App\Models\IncubateeModel;
use App\Models\TeamMemberModel;
use App\Models\SettingModel;

class Landing extends BaseController
{
    public function index(): string
    {
        $postModel      = new PostModel();
        $programModel   = new ProgramModel();
        $facilityModel  = new FacilityModel();
        $incubateeModel = new IncubateeModel();
        $teamModel      = new TeamMemberModel();
        $settingModel   = new SettingModel();

        $data = [
            'title'        => 'ASOG-TBI - Home',
            'isLanding'    => true,
            'featuredPost' => $postModel->getFeatured(),
            'latestPosts'  => $postModel->getPublished(3),
            'programs'     => $programModel->getPublished(3),
            'facilities'   => $facilityModel->getPublished(4),
            'incubatee'    => $incubateeModel->getFeaturedFirst(),
            'teamMembers'  => $teamModel->getPublished(4),
            'about'        => $settingModel->getByGroup('about'),
            'hero'         => $settingModel->getByGroup('hero'),
            'cta'          => $settingModel->getByGroup('cta'),
            'contact'      => $settingModel->getByGroup('contact'),
        ];

        return view('templates/header', $data)
            . view('landing/hero', $data)
            . view('landing/about', $data)
            . view('landing/programs', $data)
            . view('landing/facilities', $data)
            . view('landing/incubatees', $data)
            . view('landing/news', $data)
            . view('landing/organization', $data)
            . view('landing/cta', $data)
            . view('landing/contact', $data)
            . view('templates/map')
            . view('templates/footer');
    }
}