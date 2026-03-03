<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * IncubateeApplicationModel — manages incubatee applications.
 */
class IncubateeApplicationModel extends Model
{
    protected $table            = 'incubatee_applications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $createdField     = 'createdAt';
    protected $updatedField     = 'updatedAt';

    protected $allowedFields = [
        'startupName',
        'startupDescription',
        'mainRisk',
        'shortTermGoals',
        'teamCvPath',
        'leanCanvasPath',
        'videoPresentationLink',
        'applicantName',
        'applicantEmail',
        'contactNumber',
        'applicationStatus',
    ];

    protected $validationRules = [
        'startupName'              => 'required|min_length[2]|max_length[255]',
        'startupDescription'       => 'required|min_length[10]|max_length[2000]',
        'mainRisk'                 => 'max_length[1000]',
        'shortTermGoals'           => 'max_length[1000]',
        'teamCvPath'               => 'max_length[255]',
        'leanCanvasPath'           => 'max_length[500]',
        'videoPresentationLink'    => 'required|valid_url|max_length[500]',
        'applicantName'            => 'required|regex_match[/^[A-Za-z\s,\.]+$/]|max_length[255]',
        'applicantEmail'           => 'required|valid_email|max_length[255]|is_unique[incubatee_applications.applicantEmail]',
        'contactNumber'            => 'required|regex_match[/^[0-9\s\-\+\(\)]+$/]|max_length[20]',
    ];

    protected $validationMessages = [
        'startupName' => [
            'required'     => 'Startup name is required.',
            'min_length'   => 'Startup name must be at least 2 characters.',
            'max_length'   => 'Startup name cannot exceed 255 characters.',
        ],
        'startupDescription' => [
            'required'     => 'Startup description is required.',
            'min_length'   => 'Description must be at least 10 characters.',
            'max_length'   => 'Description cannot exceed 2000 characters.',
        ],
        'videoPresentationLink' => [
            'required'     => 'Video presentation link is required.',
            'valid_url'    => 'Please provide a valid YouTube or Google Drive link.',
            'max_length'   => 'URL cannot exceed 500 characters.',
        ],
        'applicantName' => [
            'required'     => 'Full name is required.',
            'regex_match'  => 'Use format: Last Name, First Name MI',
            'max_length'   => 'Name cannot exceed 255 characters.',
        ],
        'applicantEmail' => [
            'required'     => 'Email is required.',
            'valid_email'  => 'Please enter a valid email address.',
            'max_length'   => 'Email cannot exceed 255 characters.',
            'is_unique'    => 'This email has already been used in a previous application.',
        ],
        'contactNumber' => [
            'required'     => 'Contact number is required.',
            'regex_match'  => 'Please enter a valid contact number.',
            'max_length'   => 'Contact number cannot exceed 20 characters.',
        ],
    ];

    // ─── Query Scopes ─────────────────────────────────────

    public function getPending(int $limit = 0)
    {
        $builder = $this->where('applicationStatus', 'pending')
                        ->orderBy('createdAt', 'DESC');

        return $limit > 0 ? $builder->findAll($limit) : $builder->findAll();
    }

    public function getByEmail(string $email)
    {
        return $this->where('applicantEmail', $email)
                    ->first();
    }
}
