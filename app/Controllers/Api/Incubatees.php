<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CohortModel;
use App\Models\IncubateeModel;

class Incubatees extends BaseController
{
    public function index()
    {
        $incubateeModel = new IncubateeModel();
        $cohortModel = new CohortModel();

        $cohort = trim((string) ($this->request->getGet('cohort') ?? ''));
        $rows = [];

        if ($cohort !== '') {
            $rows = $incubateeModel->getPublishedByCohort($cohort);
        } else {
            $cohorts = $cohortModel->getActive();
            foreach ($cohorts as $item) {
                $rows = array_merge($rows, $incubateeModel->getPublishedByCohort($item['name']));
            }
        }

        $payload = array_map(function (array $inc): array {
            return $this->serializeIncubatee($inc);
        }, $rows);

        return $this->response->setJSON([
            'data' => $payload,
        ]);
    }

    private function serializeIncubatee(array $inc): array
    {
        $contacts = [];
        if (! empty($inc['contactDetails'])) {
            $decodedContacts = json_decode((string) $inc['contactDetails'], true);
            if (is_array($decodedContacts)) {
                foreach ($decodedContacts as $contact) {
                    if (! is_array($contact)) {
                        continue;
                    }

                    $contacts[] = [
                        'person' => html_entity_decode((string) ($contact['person'] ?? $contact['name'] ?? ''), ENT_QUOTES, 'UTF-8'),
                        'number' => html_entity_decode((string) ($contact['number'] ?? $contact['phone'] ?? ''), ENT_QUOTES, 'UTF-8'),
                        'email'  => html_entity_decode((string) ($contact['email'] ?? ''), ENT_QUOTES, 'UTF-8'),
                    ];
                }
            }
        }

        if (empty($contacts)) {
            $legacyPerson = html_entity_decode((string) ($inc['contactName'] ?? ''), ENT_QUOTES, 'UTF-8');
            $legacyNumber = html_entity_decode((string) ($inc['contactNumber'] ?? ''), ENT_QUOTES, 'UTF-8');
            $legacyEmail = html_entity_decode((string) ($inc['contactEmail'] ?? ''), ENT_QUOTES, 'UTF-8');

            if ($legacyPerson !== '' || $legacyNumber !== '' || $legacyEmail !== '') {
                $contacts[] = [
                    'person' => $legacyPerson,
                    'number' => $legacyNumber,
                    'email'  => $legacyEmail,
                ];
            }
        }

        $teamMembers = [];
        if (! empty($inc['teamMembers'])) {
            $decodedTeam = json_decode((string) $inc['teamMembers'], true);
            if (is_array($decodedTeam)) {
                $teamMembers = array_map(static function ($member): array {
                    $member = is_array($member) ? $member : [];
                    return [
                        'name'  => html_entity_decode((string) ($member['name'] ?? ''), ENT_QUOTES, 'UTF-8'),
                        'role'  => html_entity_decode((string) ($member['role'] ?? ''), ENT_QUOTES, 'UTF-8'),
                        'photo' => ! empty($member['photo']) ? base_url($member['photo']) : '',
                    ];
                }, $decodedTeam);
            }
        }

        return [
            'companyName'      => html_entity_decode((string) ($inc['companyName'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'shortDescription' => html_entity_decode((string) ($inc['shortDescription'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'content'          => $inc['content'] ?? '',
            'sdgNumbers'       => html_entity_decode((string) ($inc['sdgNumbers'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'logoPath'         => ! empty($inc['logoPath']) ? base_url($inc['logoPath']) : '',
            'logoWhitePath'    => ! empty($inc['logoWhitePath']) ? base_url($inc['logoWhitePath']) : '',
            'websiteUrl'       => html_entity_decode((string) ($inc['websiteUrl'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'facebookUrl'      => html_entity_decode((string) ($inc['facebookUrl'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'contactDetails'   => html_entity_decode((string) ($inc['contactDetails'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'contactName'      => html_entity_decode((string) ($inc['contactName'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'contactNumber'    => html_entity_decode((string) ($inc['contactNumber'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'contactEmail'     => html_entity_decode((string) ($inc['contactEmail'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'contacts'         => $contacts,
            'cohort'           => html_entity_decode((string) ($inc['cohort'] ?? ''), ENT_QUOTES, 'UTF-8'),
            'teamMembers'      => $teamMembers,
        ];
    }
}
