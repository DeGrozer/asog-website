<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\FacilityModel;
use App\Libraries\ImageUpload;

class FacilitiesAdmin extends Controller
{
    protected FacilityModel $facilityModel;

    public function __construct()
    {
        helper(['form', 'url', 'text', 'toast']);
        $this->facilityModel = new FacilityModel();
    }

    // ── LIST ────────────────────────────────────────
    public function index()
    {
        $data = [
            'pageTitle'  => 'Facilities',
            'activePage' => 'facilities',
            'facilities' => $this->facilityModel->orderBy('sortOrder', 'ASC')->findAll(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/facilities/index', $data)
             . view('admin/layout/footer');
    }

    // ── CREATE FORM ─────────────────────────────────
    public function create()
    {
        $data = [
            'pageTitle'  => 'New Facility',
            'activePage' => 'facilities',
        ];

        return view('admin/layout/header', $data)
             . view('admin/facilities/form', $data)
             . view('admin/layout/footer');
    }

    // ── STORE ───────────────────────────────────────
    public function store()
    {
        $data = [
            'name'             => $this->request->getPost('name'),
            'shortDescription' => $this->request->getPost('shortDescription'),
            'content'          => $this->request->getPost('content'),
            'sortOrder'        => (int) $this->request->getPost('sortOrder'),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        $data['slug'] = $this->facilityModel->generateSlug($data['name']);

        $file = $this->request->getFile('image');
        if ($file !== null && $file->isValid()) {
            $uploader = new ImageUpload();
            $path = $uploader->upload($file, 'facilities');
            if ($path !== null) {
                $data['imagePath'] = $path;
            } else {
                setToast('error', $uploader->getError());
                return redirect()->back()->withInput();
            }
        }

        if (! $this->facilityModel->insert($data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->facilityModel->errors()));
            return redirect()->back()->withInput();
        }

        setToast('success', 'Facility created.');
        return redirect()->to(site_url('admin/facilities'));
    }

    // ── EDIT FORM ───────────────────────────────────
    public function edit(int $id)
    {
        $facility = $this->facilityModel->find($id);
        if (! $facility) {
            setToast('error', 'Facility not found.');
            return redirect()->to(site_url('admin/facilities'));
        }

        $data = [
            'pageTitle'  => 'Edit Facility',
            'activePage' => 'facilities',
            'facility'   => $facility,
        ];

        return view('admin/layout/header', $data)
             . view('admin/facilities/form', $data)
             . view('admin/layout/footer');
    }

    // ── UPDATE ──────────────────────────────────────
    public function update(int $id)
    {
        $facility = $this->facilityModel->find($id);
        if (! $facility) {
            setToast('error', 'Facility not found.');
            return redirect()->to(site_url('admin/facilities'));
        }

        $data = [
            'name'             => $this->request->getPost('name'),
            'shortDescription' => $this->request->getPost('shortDescription'),
            'content'          => $this->request->getPost('content'),
            'sortOrder'        => (int) $this->request->getPost('sortOrder'),
            'isPublished'      => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        if ($data['name'] !== $facility['name']) {
            $data['slug'] = $this->facilityModel->generateSlug($data['name'], $id);
        }

        $file = $this->request->getFile('image');
        if ($file !== null && $file->isValid()) {
            $uploader = new ImageUpload();
            $path = $uploader->upload($file, 'facilities');
            if ($path !== null) {
                if (! empty($facility['imagePath'])) {
                    $uploader->delete($facility['imagePath']);
                }
                $data['imagePath'] = $path;
            } else {
                setToast('error', $uploader->getError());
                return redirect()->back()->withInput();
            }
        }

        if (! $this->facilityModel->update($id, $data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->facilityModel->errors()));
            return redirect()->back()->withInput();
        }

        setToast('success', 'Facility updated.');
        return redirect()->to(site_url('admin/facilities'));
    }

    // ── DELETE ──────────────────────────────────────
    public function delete(int $id)
    {
        $facility = $this->facilityModel->find($id);
        if (! $facility) {
            setToast('error', 'Facility not found.');
            return redirect()->to(site_url('admin/facilities'));
        }

        if (! empty($facility['imagePath'])) {
            (new ImageUpload())->delete($facility['imagePath']);
        }

        $this->facilityModel->delete($id);
        setToast('success', 'Facility deleted.');
        return redirect()->to(site_url('admin/facilities'));
    }
}
