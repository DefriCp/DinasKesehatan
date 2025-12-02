<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PelayananKesehatanIbuDashboardService;

class PelayananKesehatanIbuDashboardController extends Controller
{

    public function __invoke()
    {
        $data = PelayananKesehatanIbuDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Pelayanan Kesehatan Ibu',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Cakupan K1, K4, dan K6 per Puskesmas',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'K1 (%)',
                        'data'  => $data['chart']['k1_persen'],
                    ],
                    [
                        'label' => 'K4 (%)',
                        'data'  => $data['chart']['k4_persen'],
                    ],
                    [
                        'label' => 'K6 (%)',
                        'data'  => $data['chart']['k6_persen'],
                    ],
                ],
            ],
        ]);
    }
}
