<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\IncubateeModel;
use App\Libraries\ImageUpload;

class IncubateesAdmin extends Controller
{
    protected IncubateeModel $incubateeModel;

    public function __construct()
    {
        helper(['form', 'url', 'text', 'toast']);
        $this->incubateeModel = new IncubateeModel();
    }

    // ── LIST ────────────────────────────────────────
    public function index()
    {
        $data = [
            'pageTitle'  => 'Incubatees',
            'activePage' => 'incubatees',
            'incubatees' => $this->incubateeModel->orderBy('sortOrder', 'ASC')->findAll(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/incubatees/index', $data)
             . view('admin/layout/footer');
    }

    // ── CREATE FORM ─────────────────────────────────
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

    // ── STORE ───────────────────────────────────────
    public function store()
    {
        $data = [
            'companyName'      => $this->request->getPost('companyName'),
            'founderName'      => $this->request->getPost('founderName'),
            'shortDescription' => $this->request->getPost('shortDescription'),
            'content'          => $this->request->getPost('content'),
            'websiteUrl'       => $this->request->getPost('websiteUrl'),
            'cohort'           => $this->request->getPost('cohort'),
            'sortOrder'        => (int) $this->request->getPost('sortOrder'),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        $data['slug'] = $this->incubateeModel->generateSlug($data['companyName']);

        $file = $this->request->getFile('logo');
        if ($file !== null && $file->isValid()) {
            $uploader = new ImageUpload();
            $path = $uploader->upload($file, 'incubatees');
            if ($path !== null) {
                $data['logoPath'] = $path;
            } else {
                setToast('error', $uploader->getError());
                return redirect()->back()->withInput();
            }
        }

        if (! $this->incubateeModel->insert($data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->incubateeModel->errors()));
            return redirect()->back()->withInput();
        }

        setToast('success', 'Incubatee created.');
        return redirect()->to(site_url('admin/incubatees'));
    }

    // ── EDIT FORM ───────────────────────────────────
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

    // ── UPDATE ──────────────────────────────────────
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
            'sortOrder'        => (int) $this->request->getPost('sortOrder'),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        if ($data['companyName'] !== $incubatee['companyName']) {
            $data['slug'] = $this->incubateeModel->generateSlug($data['companyName'], $id);
        }

        $file = $this->request->getFile('logo');
        if ($file !== null && $file->isValid()) {
            $uploader = new ImageUpload();
            $path = $uploader->upload($file, 'incubatees');
            if ($path !== null) {
                if (! empty($incubatee['logoPath'])) {
                    $uploader->delete($incubatee['logoPath']);
                }
                $data['logoPath'] = $path;
            } else {
                setToast('error', $uploader->getError());
                return redirect()->back()->withInput();
            }
        }

        if (! $this->incubateeModel->update($id, $data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->incubateeModel->errors()));
            return redirect()->back()->withInput();
        }

        setToast('success', 'Incubatee updated.');
        return redirect()->to(site_url('admin/incubatees'));
    }

    // ── DELETE ──────────────────────────────────────
    public function delete(int $id)
    {
        $incubatee = $this->incubateeModel->find($id);
        if (! $incubatee) {
            setToast('error', 'Incubatee not found.');
            return redirect()->to(site_url('admin/incubatees'));
        }

        if (! empty($incubatee['logoPath'])) {
            (new ImageUpload())->delete($incubatee['logoPath']);
        }

        $this->incubateeModel->delete($id);
        setToast('success', 'Incubatee deleted.');
        return redirect()->to(site_url('admin/incubatees'));
    }
}
