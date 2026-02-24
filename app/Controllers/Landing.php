<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Landing extends BaseController
{
    public function index(): string
    {
        $data = ['title' => 'ASOG-TBI - Home'];
        return view('templates/header', $data)
            . view('landing/hero')
            . view('landing/about')        
            . view('landing/programs')     
            . view('landing/facilities')   // #facilities - infrastructure
            . view('landing/incubatees')   // #incubatees - spotlight
            . view('landing/news')         // #news - latest updates
            . view('landing/organization') // #organization - team
            . view('landing/cta')          // #cta - be an incubatee
            . view('landing/contact')      // #contact - contact form
            . view('templates/map')        // Map with location info
            . view('templates/footer');
    }
}
