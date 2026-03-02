<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IncubateeModel;

class Incubatees extends BaseController
{
    public function index(): string
    {
        $incubateeModel = new IncubateeModel();

        $data = [
            'title'      => 'Incubatees - ASOG-TBI',
            'incubatees' => $incubateeModel->getPublished(),
        ];

        $data['heroSubtitle'] = 'Our Startups';
        $data['heroTitle']    = 'Incubatees';
        $data['heroDesc']     = 'Meet the startups and innovators being nurtured through the ASOG-TBI incubation program.';

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('incubatees/list', $data)
            . view('templates/footer');
    }

    public function show(string $slug): string
    {
        $incubateeModel = new IncubateeModel();
        $incubatee = $incubateeModel->getBySlug($slug);

        if (! $incubatee) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Incubatee not found.');
        }

        $data = [
            'title'      => esc($incubatee['companyName']) . ' - ASOG-TBI',
            'incubatee'  => $incubatee,
            'incubatees' => $incubateeModel->getPublished(),
        ];

        return view('templates/header', $data)
            . view('incubatees/detail', $data)
            . view('templates/footer');
    }
}