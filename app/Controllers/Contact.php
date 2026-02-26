<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class Contact extends BaseController
{
    public function index(): string
    {
        $settingModel = new SettingModel();

        $data = [
            'title'        => 'Contact - ASOG-TBI',
            'contact'      => $settingModel->getByGroup('contact'),
            'heroSubtitle' => 'Get In Touch',
            'heroTitle'    => 'Contact Us',
            'heroDesc'     => 'Reach out to ASOG-TBI for partnerships, inquiries, or incubation applications.',
        ];

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('landing/contact', $data)
            . view('templates/map')
            . view('templates/footer');
    }

    /**
     * Handle contact form submission.
     */
    public function send()
    {
        helper('toast');

        $rules = [
            'name'    => 'required|min_length[2]|max_length[100]',
            'email'   => 'required|valid_email|max_length[150]',
            'message' => 'required|min_length[10]|max_length[2000]',
        ];

        if (! $this->validate($rules)) {
            setToast('error', 'Please fill in all fields correctly.');
            return redirect()->back()->withInput();
        }

        $name    = $this->request->getPost('name');
        $email   = $this->request->getPost('email');
        $message = $this->request->getPost('message');

        // Log the contact message (could be emailed or stored in DB later)
        log_message('info', "Contact form: Name={$name}, Email={$email}, Message={$message}");

        setToast('success', 'Your message has been sent! We\'ll get back to you soon.');
        return redirect()->to(site_url('contact'));
    }
}