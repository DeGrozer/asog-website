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

    // ──────────────────────────────────────────────
    // LIST
    // ──────────────────────────────────────────────
    public function index()
    {
        $data = [
            'pageTitle'   => 'Incubatees',
            'activePage'  => 'incubatees',
            'incubatees'  => $this->incubateeModel->orderBy('sortOrder', 'ASC')->orderBy('createdAt', 'DESC')->findAll(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/incubatees/index', $data)
             . view('admin/layout/footer');
    }

    // ──────────────────────────────────────────────
    // CREATE FORM
    // ──────────────────────────────────────────────
    public function create()
    {
        $data = [
            'pageTitle'  => 'New Incubatee',
            'activePage' => 'incubatees',
        ];

        return view('admin/layout/header', $data)
             . view('admin/incubatees/form', $data)
             . view('admin/layout/footer');
    }

    // ──────────────────────────────────────────────
    // STORE
    // ──────────────────────────────────────────────
    public function store()
    {
        $data = [
            'companyName'      => $this->request->getPost('companyName'),
            'founderName'      => $this->request->getPost('founderName'),
            'shortDescription' => $this->request->getPost('shortDescription'),
            'content'          => $this->request->getPost('content'),
            'websiteUrl'       => $this->request->getPost('websiteUrl'),
            'cohort'           => $this->request->getPost('cohort'),
            'sortOrder'        => (int) ($this->request->getPost('sortOrder') ?: 0),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        // Generate slug
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

        if (! $this->incubateeModel->insert($data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->incubateeModel->errors()));
            return redirect()->back()->withInput();
        }

        setToast('success', 'Incubatee created successfully.');
        return redirect()->to(site_url('admin/incubatees'));
    }

    // ──────────────────────────────────────────────
    // EDIT FORM
    // ──────────────────────────────────────────────
    public function edit(int $id)
    {
        $incubatee = $this->incubateeModel->find($id);

        if (! $incubatee) {
            setToast('error', 'Incubatee not found.');
            return redirect()->to(site_url('admin/incubatees'));
        }

        $data = [
            'pageTitle'  => 'Edit Incubatee',
            'activePage' => 'incubatees',
            'incubatee'  => $incubatee,
        ];

        return view('admin/layout/header', $data)
             . view('admin/incubatees/form', $data)
             . view('admin/layout/footer');
    }

    // ──────────────────────────────────────────────
    // UPDATE
    // ──────────────────────────────────────────────
    public function update(int $id)
    {
        $incubatee = $this->incubateeModel->find($id);

        if (! $incubatee) {
            setToast('error', 'Incubatee not found.');
            return redirect()->to(site_url('admin/incubatees'));
        }

        $data = [
            'companyName'      => $this->request->getPost('companyName'),
            'founderName'      => $this->request->getPost('founderName'),
            'shortDescription' => $this->request->getPost('shortDescription'),
            'content'          => $this->request->getPost('content'),
            'websiteUrl'       => $this->request->getPost('websiteUrl'),
            'cohort'           => $this->request->getPost('cohort'),
            'sortOrder'        => (int) ($this->request->getPost('sortOrder') ?: 0),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        // Regenerate slug only if name changed
        if ($data['companyName'] !== $incubatee['companyName']) {
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

        if (! $this->incubateeModel->update($id, $data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->incubateeModel->errors()));
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

        // Delete logo file
        if (! empty($incubatee['logoPath'])) {
            (new ImageUpload())->delete($incubatee['logoPath']);
        }

        $this->incubateeModel->delete($id);

        setToast('success', 'Incubatee deleted.');
        return redirect()->to(site_url('admin/incubatees'));
    }
}
