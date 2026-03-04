<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Landing extends BaseController
{
    public function index(): string
    {
        $postModel = new PostModel();

        $data = [
            'title'        => 'ASOG-TBI - Home',
            'isLanding'    => true,
            'heroSlides'   => $postModel->getFeaturedSlides(5),
            'featuredPost' => $postModel->getFeatured(),
            'latestPosts'  => $postModel->getPublished(3),
        ];

        return view('templates/header', $data)
            . view('landing/hero', $data)
            . view('landing/about', $data)
            . view('landing/programs', $data)
            . view('landing/incubatees', $data)
            . view('landing/news', $data)
            . view('landing/organization', $data)
            . view('landing/cta', $data)
            . view('landing/contact', $data)
            . view('templates/map')
            . view('templates/footer');
    }
}