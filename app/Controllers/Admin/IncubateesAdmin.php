<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\ImageUpload;

/**
 * IncubateesAdmin — Full CRUD for the incubatees showcase.
 *
 * Routes: admin/incubatees, admin/incubatees/create, admin/incubatees/(:num)/edit, etc.
 */
class IncubateesAdmin extends BaseController
{


    /**
     * List all incubatees in the admin panel.
     *
     * Retrieves incubatee records for the admin list view.
     */
    public function index()
    {
        $data = [
            'pageTitle'   => 'Incubatees',
            'activePage'  => 'incubatees',
            'incubatees'  => $this->incubateeModel->orderBy('sortOrder', 'ASC')->orderBy('createdAt', 'DESC')->findAll(),
            'cohorts'     => $this->cohortModel->getAllSorted(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/incubatees/index', $data)
             . view('admin/layout/footer');
    }

    public function create()
    {
        $data = [
            'pageTitle'       => 'New Incubatee',
            'activePage'      => 'incubatees',
            'existingCohorts' => $this->cohortModel->getActiveNames(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/incubatees/form', $data)
             . view('admin/layout/footer');
    }

    /**
     * Store a new incubatee.
     *
     * Validates and transforms request data, handles logo uploads,
     * and inserts a new incubatee record.
     */


    public function store()
    {
        $content = trim($this->request->getPost('content') ?? '');
        
        // Quill sends <p><br></p> when editor is empty — treat as null
        if (in_array($content, ['', '<p><br></p>', '<p></p>'], true)) {
            $content = null;
        }

        // Build team members JSON from repeater inputs
        $tmNames = $this->request->getPost('tm_name') ?? [];
        $tmRoles = $this->request->getPost('tm_role') ?? [];
        $teamMembers = [];
        foreach ($tmNames as $i => $name) {
            $name = trim($name);
            if ($name !== '') {
                $teamMembers[] = ['name' => $name, 'role' => trim($tmRoles[$i] ?? '')];
            }
        }

        $data = [
            'companyName'      => trim($this->request->getPost('companyName') ?? ''),
            'founderName'      => trim($this->request->getPost('founderName') ?? '') ?: null,
            'shortDescription' => trim($this->request->getPost('shortDescription') ?? '') ?: null,
            'content'          => $content,
            'websiteUrl'       => trim($this->request->getPost('websiteUrl') ?? '') ?: null,
            'facebookUrl'      => trim($this->request->getPost('facebookUrl') ?? '') ?: null,
            'cohort'           => trim($this->request->getPost('cohort') ?? '') ?: null,
            'teamMembers'      => ! empty($teamMembers) ? json_encode($teamMembers) : null,
            'sortOrder'        => (int) ($this->request->getPost('sortOrder') ?: 0),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        // This one generates a slug. A slug is a URL-friendly version of the company name, typically lowercase with words separated by hyphens. 
        $data['slug'] = $this->incubateeModel->generateSlug($data['companyName']);

        // Handle logo upload
        try {
            $file = $this->request->getFile('logo');

            if ($file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                if (! $file->isValid()) {
                    setToast('error', 'Logo upload failed: ' . $file->getErrorString());
                    return redirect()->back()->withInput();
                }

                if ($file->hasMoved()) {
                    setToast('error', 'Logo upload error: file was already processed.');
                    return redirect()->back()->withInput();
                }

                $uploader = new ImageUpload();
                $path = $uploader->upload($file, 'incubatees');
                if ($path !== null) {
                    $data['logoPath'] = $path;
                } else {
                    setToast('error', 'Logo upload failed: ' . $uploader->getError());
                    return redirect()->back()->withInput();
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Incubatee logo upload error: ' . $e->getMessage());
            setToast('error', 'Logo upload error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }

        // Handle white logo upload
        try {
            $whiteFile = $this->request->getFile('logoWhite');

            if ($whiteFile !== null && $whiteFile->getError() !== UPLOAD_ERR_NO_FILE) {
                if (! $whiteFile->isValid()) {
                    setToast('error', 'White logo upload failed: ' . $whiteFile->getErrorString());
                    return redirect()->back()->withInput();
                }

                if ($whiteFile->hasMoved()) {
                    setToast('error', 'White logo upload error: file was already processed.');
                    return redirect()->back()->withInput();
                }

                $uploader = new ImageUpload();
                $whitePath = $uploader->upload($whiteFile, 'incubatees');
                if ($whitePath !== null) {
                    $data['logoWhitePath'] = $whitePath;
                } else {
                    setToast('error', 'White logo upload failed: ' . $uploader->getError());
                    return redirect()->back()->withInput();
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Incubatee white logo upload error: ' . $e->getMessage());
            setToast('error', 'White logo upload error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }

        if (! $this->incubateeModel->insert($data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->incubateeModel->errors()));
            return redirect()->back()->withInput();
        }

        setToast('success', 'Incubatee created successfully.');
        return redirect()->to(site_url('admin/incubatees'));
    }

    /**
     * EDIT — Show form for editing an existing incubatee.
     * This method retrieves the incubatee by ID and passes it to the form view for editing. If the incubatee is not found, it redirects back with an error message.  
     */
    public function edit(int $id)
    {
        $incubatee = $this->incubateeModel->find($id);

        if (! $incubatee) {
            setToast('error', 'Incubatee not found.');
            return redirect()->to(site_url('admin/incubatees'));
        }

        $data = [
            'pageTitle'       => 'Edit Incubatee',
            'activePage'      => 'incubatees',
            'incubatee'       => $incubatee,
            'existingCohorts' => $this->cohortModel->getActiveNames(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/incubatees/form', $data)
             . view('admin/layout/footer');
    }

    /**
     * UPDATE — Handle form submission for updating an existing incubatee.
     * This method processes the form data, handles logo uploads, and updates the incubatee in the database. It includes error handling for validation and file uploads, and it also manages the deletion of old logo files if new ones are uploaded.   
     */
    public function update(int $id)
    {
        $incubatee = $this->incubateeModel->find($id);

        if (! $incubatee) {
            setToast('error', 'Incubatee not found.');
            return redirect()->to(site_url('admin/incubatees'));
        }

        $content = trim($this->request->getPost('content') ?? '');
        // Quill sends <p><br></p> when editor is empty — treat as null
        if (in_array($content, ['', '<p><br></p>', '<p></p>'], true)) {
            $content = null;
        }

        // Build team members JSON from repeater inputs
        $tmNames = $this->request->getPost('tm_name') ?? [];
        $tmRoles = $this->request->getPost('tm_role') ?? [];
        $teamMembers = [];
        foreach ($tmNames as $i => $name) {
            $name = trim($name);
            if ($name !== '') {
                $teamMembers[] = ['name' => $name, 'role' => trim($tmRoles[$i] ?? '')];
            }
        }

        $data = [
            'companyName'      => trim($this->request->getPost('companyName') ?? ''),
            'founderName'      => trim($this->request->getPost('founderName') ?? '') ?: null,
            'shortDescription' => trim($this->request->getPost('shortDescription') ?? '') ?: null,
            'content'          => $content,
            'websiteUrl'       => trim($this->request->getPost('websiteUrl') ?? '') ?: null,
            'facebookUrl'      => trim($this->request->getPost('facebookUrl') ?? '') ?: null,
            'cohort'           => trim($this->request->getPost('cohort') ?? '') ?: null,
            'teamMembers'      => ! empty($teamMembers) ? json_encode($teamMembers) : null,
            'sortOrder'        => (int) ($this->request->getPost('sortOrder') ?: 0),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        // Regenerate slug only if name changed
        if ($data['companyName'] !== ($incubatee['companyName'] ?? '')) {
            $data['slug'] = $this->incubateeModel->generateSlug($data['companyName'], $id);
        }

        // Handle logo upload (optional on edit)
        try {
            $file = $this->request->getFile('logo');

            if ($file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                if (! $file->isValid()) {
                    setToast('error', 'Logo upload failed: ' . $file->getErrorString());
                    return redirect()->back()->withInput();
                }

                if ($file->hasMoved()) {
                    setToast('error', 'Logo upload error: file was already processed.');
                    return redirect()->back()->withInput();
                }

                $uploader = new ImageUpload();
                $path = $uploader->upload($file, 'incubatees');
                if ($path !== null) {
                    // Delete old logo
                    if (! empty($incubatee['logoPath'])) {
                        $uploader->delete($incubatee['logoPath']);
                    }
                    $data['logoPath'] = $path;
                } else {
                    setToast('error', 'Logo upload failed: ' . $uploader->getError());
                    return redirect()->back()->withInput();
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Incubatee logo update error: ' . $e->getMessage());
            setToast('error', 'Logo upload error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }

        // Handle white logo upload (optional on edit)
        try {
            $whiteFile = $this->request->getFile('logoWhite');

            if ($whiteFile !== null && $whiteFile->getError() !== UPLOAD_ERR_NO_FILE) {
                if (! $whiteFile->isValid()) {
                    setToast('error', 'White logo upload failed: ' . $whiteFile->getErrorString());
                    return redirect()->back()->withInput();
                }

                if ($whiteFile->hasMoved()) {
                    setToast('error', 'White logo upload error: file was already processed.');
                    return redirect()->back()->withInput();
                }

                $uploader = new ImageUpload();
                $whitePath = $uploader->upload($whiteFile, 'incubatees');
                if ($whitePath !== null) {
                    // Delete old white logo
                    if (! empty($incubatee['logoWhitePath'])) {
                        $uploader->delete($incubatee['logoWhitePath']);
                    }
                    $data['logoWhitePath'] = $whitePath;
                } else {
                    setToast('error', 'White logo upload failed: ' . $uploader->getError());
                    return redirect()->back()->withInput();
                }
            }
        } catch (\Throwable $e) {
            log_message('error', 'Incubatee white logo update error: ' . $e->getMessage());
            setToast('error', 'White logo upload error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }

        // Use a clean DB builder for the update to avoid any residual
        // query-builder state from find() or generateSlug().
        $db = \Config\Database::connect();
        $db->table('incubatees')->where('id', $id)->update($data);

        if ($db->affectedRows() === 0) {
            setToast('error', 'Update failed — no rows were changed.');
            return redirect()->back()->withInput();
        }

        setToast('success', 'Incubatee updated successfully.');
        return redirect()->to(site_url('admin/incubatees'));
    }

    // ──────────────────────────────────────────────
    // DELETE
    // ──────────────────────────────────────────────
    public function delete(int $id)
    {
        $incubatee = $this->incubateeModel->find($id);

        if (! $incubatee) {
            setToast('error', 'Incubatee not found.');
            return redirect()->to(site_url('admin/incubatees'));
        }

        // Delete logo files
        $uploader = new ImageUpload();
        if (! empty($incubatee['logoPath'])) {
            $uploader->delete($incubatee['logoPath']);
        }
        if (! empty($incubatee['logoWhitePath'])) {
            $uploader->delete($incubatee['logoWhitePath']);
        }

        $this->incubateeModel->delete($id);

        setToast('success', 'Incubatee deleted.');
        return redirect()->to(site_url('admin/incubatees'));
    }

    // ──────────────────────────────────────────────
    // COHORT MANAGEMENT (AJAX)
    // ──────────────────────────────────────────────

    public function addCohort()
    {
        $number = $this->cohortModel->nextNumber();
        $name   = 'Cohort ' . $number;

        if (! $this->cohortModel->insert(['name' => $name, 'number' => $number])) {
            return $this->response->setJSON(['ok' => false, 'error' => implode(', ', $this->cohortModel->errors())]);
        }

        $cohort = $this->cohortModel->find($this->cohortModel->getInsertID());
        return $this->response->setJSON(['ok' => true, 'cohort' => $cohort]);
    }

    public function deleteCohort(int $id)
    {
        $cohort = $this->cohortModel->find($id);

        if (! $cohort) {
            return $this->response->setJSON(['ok' => false, 'error' => 'Cohort not found.']);
        }

        // Check if any incubatees use this cohort
        $count = $this->incubateeModel->where('cohort', $cohort['name'])->countAllResults();
        if ($count > 0) {
            return $this->response->setJSON(['ok' => false, 'error' => $cohort['name'] . ' has ' . $count . ' incubatee(s). Remove them first.']);
        }

        $this->cohortModel->delete($id);
        return $this->response->setJSON(['ok' => true]);
    }
}