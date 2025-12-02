<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TenagaKesmasKeslingdanGiziDashboardService;

class TenagaKesmasKeslingdanGiziDashboardController extends Controller
{

    public function __invoke()
    {
        $data = TenagaKesmasKeslingdanGiziDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Tenaga Kesmas, Kesling, dan Gizi',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Kesmas, Kesling, dan Gizi per Unit Kerja',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Kesmas (Total)',
                        'data'  => $data['chart']['kesmas_total'],
                    ],
                    [
                        'label' => 'Kesling (Total)',
                        'data'  => $data['chart']['kesling_total'],
                    ],
                    [
                        'label' => 'Gizi (Total)',
                        'data'  => $data['chart']['gizi_total'],
                    ],
                ],
            ],
        ]);
    }
}
