<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TenagaTeknikBiomedikaKeterapianKeteknisianDashboardService;

class TenagaTeknikBiomedikaKeterapianKeteknisianDashboardController extends Controller
{

    public function __invoke()
    {
        $data = TenagaTeknikBiomedikaKeterapianKeteknisianDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Tenaga Teknik Biomedika, Keterapian, dan Keteknisian',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'ATL, Biomedika, Keterapian, Keteknisian per Unit Kerja',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'ATL (Total)',
                        'data'  => $data['chart']['atl_total'],
                    ],
                    [
                        'label' => 'Biomedika (Total)',
                        'data'  => $data['chart']['biomedika_total'],
                    ],
                    [
                        'label' => 'Keterapian Fisik (Total)',
                        'data'  => $data['chart']['keterapian_total'],
                    ],
                    [
                        'label' => 'Keteknisian Medis (Total)',
                        'data'  => $data['chart']['keteknisian_total'],
                    ],
                ],
            ],
        ]);
    }
}
