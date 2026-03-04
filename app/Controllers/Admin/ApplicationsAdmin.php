<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * ApplicationsAdmin — Review & manage incubatee applications.
 *
 * Routes: admin/applications, admin/applications/(:num), etc.
 */
class ApplicationsAdmin extends BaseController
{

    // ──────────────────────────────────────────────
    // LIST
    // ──────────────────────────────────────────────
    public function index()
    {
        $applications = $this->applicationModel->getAll();

        $data = [
            'pageTitle'    => 'Applications',
            'activePage'   => 'applications',
            'applications' => $applications,
            'counts'       => [
                'total'    => count($applications),
                'pending'  => count(array_filter($applications, fn($a) => $a['applicationStatus'] === 'pending')),
                'accepted' => count(array_filter($applications, fn($a) => $a['applicationStatus'] === 'accepted')),
                'rejected' => count(array_filter($applications, fn($a) => $a['applicationStatus'] === 'rejected')),
            ],
        ];

        return view('admin/layout/header', $data)
             . view('admin/applications/index', $data)
             . view('admin/layout/footer');
    }

    // ──────────────────────────────────────────────
    // SHOW (JSON — consumed by the review modal)
    // ──────────────────────────────────────────────
    public function show(int $id)
    {
        $app = $this->applicationModel->find($id);

        if (! $app) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Application not found.']);
        }

        return $this->response->setJSON($app);
    }

    // ──────────────────────────────────────────────
    // UPDATE STATUS (accept / reject / change via PUT)
    // ──────────────────────────────────────────────
    public function updateStatus(int $id)
    {
        $app = $this->applicationModel->find($id);

        if (! $app) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Application not found.']);
        }

        $status = $this->request->getJSON(true)['status'] ?? '';

        if (! $this->applicationModel->updateStatus($id, $status)) {
            return $this->response->setStatusCode(422)->setJSON(['error' => 'Invalid status value.']);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Application marked as ' . $status . '.',
        ]);
    }
}
