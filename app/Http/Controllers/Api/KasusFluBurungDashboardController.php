<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\KasusFluBurungDashboardService;

class KasusFluBurungDashboardController extends Controller
{
    /**
     * GET /api/v1/kasus-flu-burung/dashboard
     */
    public function __invoke()
    {
        $data = KasusFluBurungDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Kasus Flu Burung',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Kasus & Kematian Flu Burung per Kecamatan',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Total Kasus',
                        'data'  => $data['chart']['kasus_total'],
                    ],
                    [
                        'label' => 'Total Kematian',
                        'data'  => $data['chart']['kematian_total'],
                    ],
                    [
                        'label' => 'CFR (%)',
                        'data'  => $data['chart']['cfr_persen'],
                    ],
                ],
            ],
        ]);
    }
}
