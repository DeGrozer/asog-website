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
    /**
     * List all contact messages.
     *
     * Retrieves all messages and prepares total, unread, and read counts
     * for the admin list view.
     */
     
    public function index()
    {
        $data = [
            'pageTitle'  => 'Messages',
            'activePage' => 'messages',
            'messages'   => $this->contactModel->getAll(),
            'counts'     => $this->contactModel->getCounts(),
        ];

        return view('admin/layout/header', $data)
             . view('admin/messages/index', $data)
             . view('admin/layout/footer');
    }

    /**
     * This method retrieves a specific message by ID and returns it as JSON.
     * When a message is viewed, it is automatically marked as read if it was previously unread.
     * If the message is not found, it returns a 404 error response. 
     */
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
    /**
     * This method toggles the read/unread status of a message. It retrieves the message by ID, checks its current read status, and updates it to the opposite state. The response includes the new read status and a message indicating whether it was marked as read or unread. If the message is not found, it returns a 404 error response.
     * This allows admins to easily manage the read status of messages directly from the message list without needing to view each message individually.
     */

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

    /**
     * Delete a message.
     *
     * Removes a message by ID and returns a JSON response.
     * Returns 404 when the message does not exist.
     */

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