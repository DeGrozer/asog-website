<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\TeamMemberModel;
use App\Libraries\ImageUpload;

class TeamAdmin extends Controller
{
    protected TeamMemberModel $teamModel;

    public function __construct()
    {
        helper(['form', 'url', 'text', 'toast']);
        $this->teamModel = new TeamMemberModel();
    }

    // ── LIST ────────────────────────────────────────
    public function index()
    {
        $data = [
            'pageTitle'  => 'Team Members',
            'activePage' => 'team',
            'members'    => $this->teamModel->orderBy('sortOrder', 'ASC')->findAll(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/team/index', $data)
             . view('admin/layout/footer');
    }

    // ── CREATE FORM ─────────────────────────────────
    public function create()
    {
        $data = [
            'pageTitle'  => 'New Team Member',
            'activePage' => 'team',
        ];

        return view('admin/layout/header', $data)
             . view('admin/team/form', $data)
             . view('admin/layout/footer');
    }

    // ── STORE ───────────────────────────────────────
    public function store()
    {
        $data = [
            'fullName'    => $this->request->getPost('fullName'),
            'position'    => $this->request->getPost('position'),
            'shortBio'    => $this->request->getPost('shortBio'),
            'content'     => $this->request->getPost('content'),
            'email'       => $this->request->getPost('email'),
            'linkedinUrl' => $this->request->getPost('linkedinUrl'),
            'sortOrder'   => (int) $this->request->getPost('sortOrder'),
            'isPublished' => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        $data['slug'] = $this->teamModel->generateSlug($data['fullName']);

        $file = $this->request->getFile('photo');
        if ($file !== null && $file->isValid()) {
            $uploader = new ImageUpload();
            $path = $uploader->upload($file, 'team');
            if ($path !== null) {
                $data['photoPath'] = $path;
            } else {
                setToast('error', $uploader->getError());
                return redirect()->back()->withInput();
            }
        }

        if (! $this->teamModel->insert($data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->teamModel->errors()));
            return redirect()->back()->withInput();
        }

        setToast('success', 'Team member added.');
        return redirect()->to(site_url('admin/team'));
    }

    // ── EDIT FORM ───────────────────────────────────
    public function edit(int $id)
    {
        $member = $this->teamModel->find($id);
        if (! $member) {
            setToast('error', 'Team member not found.');
            return redirect()->to(site_url('admin/team'));
        }

        $data = [
            'pageTitle'  => 'Edit Team Member',
            'activePage' => 'team',
            'member'     => $member,
        ];

        return view('admin/layout/header', $data)
             . view('admin/team/form', $data)
             . view('admin/layout/footer');
    }

    // ── UPDATE ──────────────────────────────────────
    public function update(int $id)
    {
        $member = $this->teamModel->find($id);
        if (! $member) {
            setToast('error', 'Team member not found.');
            return redirect()->to(site_url('admin/team'));
        }

        $data = [
            'fullName'    => $this->request->getPost('fullName'),
            'position'    => $this->request->getPost('position'),
            'shortBio'    => $this->request->getPost('shortBio'),
            'content'     => $this->request->getPost('content'),
            'email'       => $this->request->getPost('email'),
            'linkedinUrl' => $this->request->getPost('linkedinUrl'),
            'sortOrder'   => (int) $this->request->getPost('sortOrder'),
            'isPublished' => $this->request->getPost('isPublished') ? 1 : 0,
        ];

        if ($data['fullName'] !== $member['fullName']) {
            $data['slug'] = $this->teamModel->generateSlug($data['fullName'], $id);
        }

        $file = $this->request->getFile('photo');
        if ($file !== null && $file->isValid()) {
            $uploader = new ImageUpload();
            $path = $uploader->upload($file, 'team');
            if ($path !== null) {
                if (! empty($member['photoPath'])) {
                    $uploader->delete($member['photoPath']);
                }
                $data['photoPath'] = $path;
            } else {
                setToast('error', $uploader->getError());
                return redirect()->back()->withInput();
            }
        }

        if (! $this->teamModel->update($id, $data)) {
            setToast('error', 'Validation failed: ' . implode(', ', $this->teamModel->errors()));
            return redirect()->back()->withInput();
        }

        setToast('success', 'Team member updated.');
        return redirect()->to(site_url('admin/team'));
    }

    // ── DELETE ──────────────────────────────────────
    public function delete(int $id)
    {
        $member = $this->teamModel->find($id);
        if (! $member) {
            setToast('error', 'Team member not found.');
            return redirect()->to(site_url('admin/team'));
        }

        if (! empty($member['photoPath'])) {
            (new ImageUpload())->delete($member['photoPath']);
        }

        $this->teamModel->delete($id);
        setToast('success', 'Team member deleted.');
        return redirect()->to(site_url('admin/team'));
    }
}
