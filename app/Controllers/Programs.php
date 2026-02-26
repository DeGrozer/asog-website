<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProgramModel;

class Programs extends BaseController
{
    public function index(): string
    {
        $programModel = new ProgramModel();

        $data = [
            'title'        => 'Programs & Services - ASOG-TBI',
            'programs'     => $programModel->getPublished(),
            'heroSubtitle' => 'Programs & Services',
            'heroTitle'    => 'What We Offer',
            'heroDesc'     => 'Explore our incubation, mentorship, and IP support programs designed to accelerate startups and MSMEs.',
        ];

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('programs/list', $data)
            . view('templates/footer');
    }

    public function show(string $slug): string
    {
        $programModel = new ProgramModel();
        $program = $programModel->getBySlug($slug);

        if (! $program) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Program not found.');
        }

        $data = [
            'title'    => esc($program['title']) . ' - ASOG-TBI',
            'program'  => $program,
            'programs' => $programModel->getPublished(),
        ];

        return view('templates/header', $data)
            . view('programs/detail', $data)
            . view('templates/footer');
    }
}