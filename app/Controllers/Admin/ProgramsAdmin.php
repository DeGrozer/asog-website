<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\ProgramModel;
use App\Libraries\ImageUpload;

class ProgramsAdmin extends Controller
{
    protected ProgramModel $programModel;

    public function __construct()
    {
        helper(['form', 'url', 'text', 'toast']);
        $this->programModel = new ProgramModel();
    }

    // ── LIST ──────────────────────────────────────
    public function index()
    {
        $data = [
            'pageTitle'  => 'Programs',
            'activePage' => 'programs',
            'programs'   => $this->programModel->orderBy('sortOrder', 'ASC')->findAll(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/programs/index', $data)
             . view('admin/layout/footer');
    }

    // ── CREATE FORM ──────────────────────────────
    public function create()
    {
        $data = [
            'pageTitle'  => 'New Program',
            'activePage' => 'programs',
        ];

        return view('admin/layout/header', $data)
             . view('admin/programs/form', $data)
             . view('admin/layout/footer');
    }

    // ── STORE ────────────────────────────────────
    public function store()
    {
        $data = [
            'title'            => $this->request->getPost('title'),
            'shortDescription' => $this->request->getPost('shortDescription'),
            'content'          => $this->request->getPost('content'),
            'iconSvg'          => $this->request->getPost('iconSvg'),
            'sortOrder'        => (int) $this->request->getPost('sortOrder'),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        $data['slug'] = $this->programModel->generateSlug($data['title']);

        $file = $this->request->getFile('image');
        if ($file !== null && $file->isValid()) {
            $uploader = new ImageUpload();
            $path = $uploader->upload($file, 'programs');
            if ($path !== null) {
                $data['imagePath'] = $path;
            } else {
                setToast('error', $uploader->getError());
                return redirect()->back()->withInput();
            }
        }

        if (! $this->programModel->insert($data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->programModel->errors()));
            return redirect()->back()->withInput();
        }

        setToast('success', 'Program created.');
        return redirect()->to(site_url('admin/programs'));
    }

    // ── EDIT FORM ────────────────────────────────
    public function edit(int $id)
    {
        $program = $this->programModel->find($id);
        if (! $program) {
            setToast('error', 'Program not found.');
            return redirect()->to(site_url('admin/programs'));
        }

        $data = [
            'pageTitle'  => 'Edit Program',
            'activePage' => 'programs',
            'program'    => $program,
        ];

        return view('admin/layout/header', $data)
             . view('admin/programs/form', $data)
             . view('admin/layout/footer');
    }

    // ── UPDATE ───────────────────────────────────
    public function update(int $id)
    {
        $program = $this->programModel->find($id);
        if (! $program) {
            setToast('error', 'Program not found.');
            return redirect()->to(site_url('admin/programs'));
        }

        $data = [
            'title'            => $this->request->getPost('title'),
            'shortDescription' => $this->request->getPost('shortDescription'),
            'content'          => $this->request->getPost('content'),
            'iconSvg'          => $this->request->getPost('iconSvg'),
            'sortOrder'        => (int) $this->request->getPost('sortOrder'),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        if ($data['title'] !== $program['title']) {
            $data['slug'] = $this->programModel->generateSlug($data['title'], $id);
        }

        $file = $this->request->getFile('image');
        if ($file !== null && $file->isValid()) {
            $uploader = new ImageUpload();
            $path = $uploader->upload($file, 'programs');
            if ($path !== null) {
                if (! empty($program['imagePath'])) {
                    $uploader->delete($program['imagePath']);
                }
                $data['imagePath'] = $path;
            } else {
                setToast('error', $uploader->getError());
                return redirect()->back()->withInput();
            }
        }

        if (! $this->programModel->update($id, $data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->programModel->errors()));
            return redirect()->back()->withInput();
        }

        setToast('success', 'Program updated.');
        return redirect()->to(site_url('admin/programs'));
    }

    // ── DELETE ────────────────────────────────────
    public function delete(int $id)
    {
        $program = $this->programModel->find($id);
        if (! $program) {
            setToast('error', 'Program not found.');
            return redirect()->to(site_url('admin/programs'));
        }

        if (! empty($program['imagePath'])) {
            (new ImageUpload())->delete($program['imagePath']);
        }

        $this->programModel->delete($id);
        setToast('success', 'Program deleted.');
        return redirect()->to(site_url('admin/programs'));
    }
}
