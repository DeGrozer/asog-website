<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * MessagesAdmin — View & manage contact-form submissions.
 *
 * Routes: admin/messages, admin/messages/(:num), etc.
 */
class MessagesAdmin extends BaseController
{
    // ──────────────────────────────────────────────
    // LIST
    // ──────────────────────────────────────────────
    public function index()
    {
        $messages = $this->contactModel->getAll();

        $data = [
            'pageTitle'  => 'Messages',
            'activePage' => 'messages',
            'messages'   => $messages,
            'counts'     => [
                'total'  => count($messages),
                'unread' => count(array_filter($messages, fn($m) => $m['isRead'] == 0)),
                'read'   => count(array_filter($messages, fn($m) => $m['isRead'] == 1)),
            ],
        ];

        return view('admin/layout/header', $data)
             . view('admin/messages/index', $data)
             . view('admin/layout/footer');
    }

    // ──────────────────────────────────────────────
    // SHOW (JSON — consumed by the detail modal)
    // ──────────────────────────────────────────────
    public function show(int $id)
    {
        $msg = $this->contactModel->find($id);

        if (! $msg) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Message not found.']);
        }

        // Auto-mark as read when viewed
        if (! $msg['isRead']) {
            $this->contactModel->markRead($id);
            $msg['isRead'] = 1;
        }

        return $this->response->setJSON($msg);
    }

    // ──────────────────────────────────────────────
    // MARK READ / UNREAD (PUT)
    // ──────────────────────────────────────────────
    public function toggleRead(int $id)
    {
        $msg = $this->contactModel->find($id);

        if (! $msg) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Message not found.']);
        }

        $newState = $msg['isRead'] ? 0 : 1;
        $this->contactModel->update($id, ['isRead' => $newState]);

        return $this->response->setJSON([
            'success' => true,
            'isRead'  => $newState,
            'message' => $newState ? 'Marked as read.' : 'Marked as unread.',
        ]);
    }

    // ──────────────────────────────────────────────
    // DELETE
    // ──────────────────────────────────────────────
    public function delete(int $id)
    {
        $msg = $this->contactModel->find($id);

        if (! $msg) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Message not found.']);
        }

        $this->contactModel->delete($id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Message deleted.',
        ]);
    }
}
