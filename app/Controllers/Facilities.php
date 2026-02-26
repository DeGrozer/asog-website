<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FacilityModel;

class Facilities extends BaseController
{
    public function index(): string
    {
        $facilityModel = new FacilityModel();

        $data = [
            'title'        => 'Facilities - ASOG-TBI',
            'facilities'   => $facilityModel->getPublished(),
            'heroSubtitle' => 'Infrastructure',
            'heroTitle'    => 'Our Facilities',
            'heroDesc'     => 'See our labs, coworking spaces, and partner facilities powering innovation in the Bicol Region.',
        ];

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('facilities/list', $data)
            . view('templates/footer');
    }

    public function show(string $slug): string
    {
        $facilityModel = new FacilityModel();
        $facility = $facilityModel->getBySlug($slug);

        if (! $facility) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Facility not found.');
        }

        $data = [
            'title'      => esc($facility['name']) . ' - ASOG-TBI',
            'facility'   => $facility,
            'facilities' => $facilityModel->getPublished(),
        ];

        return view('templates/header', $data)
            . view('facilities/detail', $data)
            . view('templates/footer');
    }
}