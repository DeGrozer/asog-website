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

    /**
     * List all applications received by the TBI.
     *
     * Retrieves all applications and prepares summary counts for
     * total, pending, accepted, and rejected records.
     */

    public function index()
    {
        $data = [
            'pageTitle'    => 'Applications',
            'activePage'   => 'applications',
            'applications' => $this->applicationModel->getAll(),
            'counts'       => $this->applicationModel->getCounts(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/applications/index', $data)
             . view('admin/layout/footer');
    }

    /**
     * Show a single application as JSON.
     *
     * Used by the review modal to load application details.
     */

    public function show(int $id)
    {
        $app = $this->applicationModel->find($id);

        if (! $app) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Application not found.']);
        }

        return $this->response->setJSON($app);
    }

    /**
     * Update application status.
     *
     * Accepts the new status from the request payload, validates it,
     * and returns a JSON success response.
     */

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