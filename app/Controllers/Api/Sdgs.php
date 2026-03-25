<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class Sdgs extends BaseController
{
    /**
     * Return SDG metadata filtered by query string ids.
     * Example: /api/sdgs?ids=1,4,9
     */
    public function index()
    {
        $all = $this->getSdgMap();
        $idsParam = (string) ($this->request->getGet('ids') ?? '');

        if ($idsParam === '') {
            return $this->response->setJSON([
                'data' => array_values($all),
            ]);
        }

        $ids = array_filter(array_map('intval', explode(',', $idsParam)), static function (int $id): bool {
            return $id >= 1 && $id <= 17;
        });

        $ids = array_values(array_unique($ids));
        sort($ids);

        $data = [];
        foreach ($ids as $id) {
            if (isset($all[$id])) {
                $data[] = $all[$id];
            }
        }

        return $this->response->setJSON([
            'data' => $data,
        ]);
    }

    private function getSdgMap(): array
    {
        $rows = [
            1 => ['No Poverty', '#E5243B', '#ffffff'],
            2 => ['Zero Hunger', '#DDA63A', '#ffffff'],
            3 => ['Good Health and Well-Being', '#4C9F38', '#ffffff'],
            4 => ['Quality Education', '#C5192D', '#ffffff'],
            5 => ['Gender Equality', '#FF3A21', '#ffffff'],
            6 => ['Clean Water and Sanitation', '#26BDE2', '#0b1f2a'],
            7 => ['Affordable and Clean Energy', '#FCC30B', '#0b1f2a'],
            8 => ['Decent Work and Economic Growth', '#A21942', '#ffffff'],
            9 => ['Industry, Innovation and Infrastructure', '#FD6925', '#ffffff'],
            10 => ['Reduced Inequalities', '#DD1367', '#ffffff'],
            11 => ['Sustainable Cities and Communities', '#FD9D24', '#0b1f2a'],
            12 => ['Responsible Consumption and Production', '#BF8B2E', '#ffffff'],
            13 => ['Climate Action', '#3F7E44', '#ffffff'],
            14 => ['Life Below Water', '#0A97D9', '#ffffff'],
            15 => ['Life on Land', '#56C02B', '#0b1f2a'],
            16 => ['Peace, Justice and Strong Institutions', '#00689D', '#ffffff'],
            17 => ['Partnerships for the Goals', '#19486A', '#ffffff'],
        ];

        $map = [];
        foreach ($rows as $id => $row) {
            $number = str_pad((string) $id, 2, '0', STR_PAD_LEFT);
            $map[$id] = [
                'id' => $id,
                'name' => $row[0],
                'color' => $row[1],
                'textColor' => $row[2],
                // Suggested local files: /public/assets/img/sdg/sdg-01.webp ... sdg-17.webp
                'iconWebp' => base_url('assets/img/sdg/sdg-' . $number . '.webp'),
                'iconPng' => base_url('assets/img/sdg/sdg-' . $number . '.png'),
                'goalUrl' => 'https://sdgs.un.org/goals/goal' . $id,
            ];
        }

        return $map;
    }
}
