<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TeamMemberModel;

class Organization extends BaseController
{
    public function index(): string
    {
        $teamModel = new TeamMemberModel();

        $data = [
            'title'        => 'Organization - ASOG-TBI',
            'teamMembers'  => $teamModel->getPublished(),
            'heroSubtitle' => 'The Team',
            'heroTitle'    => 'Our Organization',
            'heroDesc'     => 'Meet the people supporting ASOG-TBI\'s mission of empowering startups and MSMEs.',
        ];

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('organization/list', $data)
            . view('templates/footer');
    }

    public function show(string $slug): string
    {
        $teamModel = new TeamMemberModel();
        $member = $teamModel->getBySlug($slug);

        if (! $member) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Team member not found.');
        }

        $data = [
            'title'       => esc($member['fullName']) . ' - ASOG-TBI',
            'member'      => $member,
            'teamMembers' => $teamModel->getPublished(),
        ];

        return view('templates/header', $data)
            . view('organization/detail', $data)
            . view('templates/footer');
    }
}