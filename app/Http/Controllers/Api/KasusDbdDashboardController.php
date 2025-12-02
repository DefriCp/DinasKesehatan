<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\KasusDbdDashboardService;

class KasusDbdDashboardController extends Controller
{
    public function __invoke()
    {
        $data = KasusDbdDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Kasus DBD',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Kasus DBD per Kecamatan',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Total Kasus',
                        'data'  => $data['chart']['kasus_total'],
                    ],
                    [
                        'label' => 'Total Meninggal',
                        'data'  => $data['chart']['meninggal_total'],
                    ],
                    [
                        'label' => 'CFR (%)',
                        'data'  => $data['chart']['cfr_total'],
                    ],
                ],
            ],
        ]);
    }
}
