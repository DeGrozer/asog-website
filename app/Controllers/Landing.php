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
            'featuredPost' => $postModel->getFeatured(),
            'latestPosts'  => $postModel->getPublished(3),
        ];

        return view('templates/header', $data)
            . view('landing/hero', $data)
            . view('landing/about')        
            . view('landing/programs')     
            . view('landing/facilities')   // #facilities - infrastructure
            . view('landing/incubatees')   // #incubatees - spotlight
            . view('landing/news', $data)  // #news - latest updates
            . view('landing/organization') // #organization - team
            . view('landing/cta')          // #cta - be an incubatee
            . view('landing/contact')      // #contact - contact form
            . view('templates/map')        // Map with location info
            . view('templates/footer');
    }
}