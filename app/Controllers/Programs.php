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
            'title'    => 'Programs & Services - ASOG-TBI',
            'programs' => $programModel->getPublished(),
        ];

        $data['heroSubtitle'] = 'What We Offer';
        $data['heroTitle']    = 'Programs & Services';
        $data['heroDesc']     = 'Explore the programs, services, and facilities that power innovation at ASOG-TBI.';

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('programs/list', $data)
            . view('templates/footer');
    }

    public function services(): string
    {
        $data = [
            'title' => 'Services Offered - ASOG-TBI',
        ];

        $data['heroSubtitle'] = 'Comprehensive Support';
        $data['heroTitle']    = 'Services Offered';
        $data['heroDesc']     = 'A comprehensive range of capacity-building services designed to support startups and MSMEs at every stage.';

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('services/list', $data)
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