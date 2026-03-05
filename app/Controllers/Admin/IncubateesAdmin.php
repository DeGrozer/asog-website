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
        $content = trim($this->request->getPost('content') ?? '');
        // Quill sends <p><br></p> when editor is empty — treat as null
        if (in_array($content, ['', '<p><br></p>', '<p></p>'], true)) {
            $content = null;
        }

        $data = [
            'companyName'      => trim($this->request->getPost('companyName') ?? ''),
            'founderName'      => trim($this->request->getPost('founderName') ?? '') ?: null,
            'shortDescription' => trim($this->request->getPost('shortDescription') ?? '') ?: null,
            'content'          => $content,
            'websiteUrl'       => trim($this->request->getPost('websiteUrl') ?? '') ?: null,
            'cohort'           => trim($this->request->getPost('cohort') ?? '') ?: null,
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

        $content = trim($this->request->getPost('content') ?? '');
        // Quill sends <p><br></p> when editor is empty — treat as null
        if (in_array($content, ['', '<p><br></p>', '<p></p>'], true)) {
            $content = null;
        }

        $data = [
            'companyName'      => trim($this->request->getPost('companyName') ?? ''),
            'founderName'      => trim($this->request->getPost('founderName') ?? '') ?: null,
            'shortDescription' => trim($this->request->getPost('shortDescription') ?? '') ?: null,
            'content'          => $content,
            'websiteUrl'       => trim($this->request->getPost('websiteUrl') ?? '') ?: null,
            'cohort'           => trim($this->request->getPost('cohort') ?? '') ?: null,
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

        // Delete logo file
        if (! empty($incubatee['logoPath'])) {
            (new ImageUpload())->delete($incubatee['logoPath']);
        }

        $this->incubateeModel->delete($id);

        setToast('success', 'Incubatee deleted.');
        return redirect()->to(site_url('admin/incubatees'));
    }
}
