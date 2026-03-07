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
     *This controller manages the contact messages sent through the website's contact form. 
     * It allows admins to view, mark as read/unread, and delete messages. 
     * The index method retrieves all messages and passes them to the view for listing, along with counts of total, unread, and read messages.
    **/
     
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
     * DELETE — This method deletes a message by ID. It first checks if the message exists, and if it does, it deletes it from the database. 
     * The response indicates whether the deletion was successful. If the message is not found, it returns a 404 error response.
     * This allows admins to remove messages that are no longer needed or relevant, helping to keep the message list organized and manageable.
     * Note: Deletion is permanent, so it should be used with caution. Consider adding a confirmation step in the UI before calling this method to prevent accidental deletions.
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