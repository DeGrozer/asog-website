<?php

namespace App\Models;

use CodeIgniter\Model;

/**  
 * ContactMessageModel — persists contact-form submissions.
**/
class ContactMessageModel extends Model
{
    protected $table            = 'contact_messages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'createdAt';
    protected $updatedField     = 'updatedAt';

    protected $allowedFields = [
        'name',
        'email',
        'message',
        'isRead',
    ];

    protected $validationRules = [
        'name'    => 'required|min_length[2]|max_length[100]',
        'email'   => 'required|valid_email|max_length[150]',
        'message' => 'required|min_length[10]|max_length[2000]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Your name is required.',
            'min_length' => 'Name must be at least 2 characters.',
            'max_length' => 'Name cannot exceed 100 characters.',
        ],
        'email' => [
            'required'    => 'Email is required.',
            'valid_email' => 'Please enter a valid email address.',
            'max_length'  => 'Email cannot exceed 150 characters.',
        ],
        'message' => [
            'required'   => 'Message is required.',
            'min_length' => 'Message must be at least 10 characters.',
            'max_length' => 'Message cannot exceed 2000 characters.',
        ],
    ];

    // ─── Query Helpers ────────────────────────────────────

    /**  
     * Return summary counts by read status.
    **/
    public function getCounts(): array
    {
        $total  = $this->countAllResults();
        $unread = $this->where('isRead', 0)->countAllResults();
        $read   = $this->where('isRead', 1)->countAllResults();

        return compact('total', 'unread', 'read');
    }

    /**  
     * All messages, newest first.
    **/
    public function getAll(): array
    {
        return $this->orderBy('createdAt', 'DESC')->findAll();
    }

    /**  
     * Unread messages, newest first.
    **/
    public function getUnread(): array
    {
        return $this->where('isRead', 0)
                    ->orderBy('createdAt', 'DESC')
                    ->findAll();
    }

    /**  
     * Count of unread messages (for badge on dashboard).
    **/
    public function countUnread(): int
    {
        return $this->where('isRead', 0)->countAllResults();
    }

    /**  
     * Mark a message as read.
    **/
    public function markRead(int $id): bool
    {
        return $this->update($id, ['isRead' => 1]);
    }
}
