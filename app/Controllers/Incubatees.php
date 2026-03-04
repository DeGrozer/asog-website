<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IncubateeApplicationModel;

class Incubatees extends BaseController
{
    public function index()
    {
        return redirect()->to(site_url('incubatees/apply'));
    }

    public function apply(): string
    {
        $data = [
            'title'        => 'Be an Incubatee - ASOG-TBI',
            'heroSubtitle' => 'Join the Program',
            'heroTitle'    => 'Be an Incubatee',
            'heroDesc'     => 'Apply to the ASOG-TBI incubation program and turn your innovation into a market-ready solution.',
        ];

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('incubatees/apply', $data)
            . view('templates/footer');
    }

    public function applyForm(): string
    {
        $data = [
            'title'        => 'Application Form - ASOG-TBI',
            'heroSubtitle' => 'Incubation Program',
            'heroTitle'    => 'Application Form',
            'heroDesc'     => 'Fill out the form below to apply for incubation at ASOG-TBI.',
        ];

        return view('templates/header', $data)
            . view('templates/page_hero', $data)
            . view('incubatees/apply_form', $data)
            . view('templates/footer');
    }

    public function applyFormStore(): \CodeIgniter\HTTP\ResponseInterface
    {
        $applicationModel = new IncubateeApplicationModel();
        
        $data = [
            'startupName'           => $this->request->getPost('startupName'),
            'startupDescription'    => $this->request->getPost('startupDescription'),
            'mainRisk'              => $this->request->getPost('mainRisk') ?? null,
            'shortTermGoals'        => $this->request->getPost('shortTermGoals') ?? null,
            'videoPresentationLink' => $this->request->getPost('videoPresentationLink'),
            'applicantName'         => $this->request->getPost('applicantName'),
            'applicantEmail'        => $this->request->getPost('applicantEmail'),
            'contactNumber'         => $this->request->getPost('contactNumber'),
            'applicationStatus'     => 'pending',
        ];

        // Validate
        if (! $applicationModel->validate($data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $applicationModel->errors());
        }

        // Handle file upload (CV)
        if ($this->request->getFileMultiple('teamCv')) {
            $files = $this->request->getFileMultiple('teamCv');
            $uploadedPaths = [];

            foreach ($files as $file) {
                if ($file->isValid() && ! $file->hasMoved()) {
                    // Validate file type and size
                    if ($file->getSize() > 104857600) { // 100 MB
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'CV file exceeds 100 MB limit.');
                    }

                    if ($file->getMimeType() !== 'application/pdf') {
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'Only PDF files are accepted for CV.');
                    }

                    $newName = $file->getRandomName();
                    $file->move(WRITEPATH . 'uploads/applications', $newName);
                    $uploadedPaths[] = 'uploads/applications/' . $newName;
                }
            }

            if (! empty($uploadedPaths)) {
                $data['teamCvPath'] = implode(',', $uploadedPaths);
            }
        }

        // Handle Lean Canvas upload
        $leanCanvasFile = $this->request->getFile('leanCanvas');
        if ($leanCanvasFile && $leanCanvasFile->isValid() && ! $leanCanvasFile->hasMoved()) {
            $allowedMimes = [
                'application/pdf',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ];

            if ($leanCanvasFile->getSize() > 10485760) { // 10 MB
                return redirect()->back()
                    ->withInput()
                    ->with('errors', array_merge($applicationModel->errors(), ['leanCanvas' => 'Lean Canvas file exceeds the 10 MB limit.']));
            }

            if (! in_array($leanCanvasFile->getMimeType(), $allowedMimes)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', array_merge($applicationModel->errors(), ['leanCanvas' => 'Only PDF or Word (.docx) files are accepted for the Lean Canvas.']));
            }

            $newName = $leanCanvasFile->getRandomName();
            $leanCanvasFile->move(WRITEPATH . 'uploads/applications', $newName);
            $data['leanCanvasPath'] = 'uploads/applications/' . $newName;
        } else {
            // Lean Canvas is required
            return redirect()->back()
                ->withInput()
                ->with('errors', array_merge($applicationModel->errors(), ['leanCanvas' => 'Please upload your completed Lean Canvas (.docx or PDF).']));
        }

        // Save application
        if ($applicationModel->insert($data)) {
            return redirect()->to(site_url('incubatees/apply/form/thank-you'))
                ->with('success', 'Your application has been submitted successfully!');
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Unable to submit application. Please try again.');
    }

    public function applyFormThankYou(): string
    {
        $data = [
            'title' => 'Application Submitted - ASOG-TBI',
        ];

        return view('templates/header', $data)
            . view('incubatees/apply_thank_you', $data)
            . view('templates/footer');
    }

}