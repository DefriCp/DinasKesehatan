<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\KejadianLuarBiasaDashboardService;

class KejadianLuarBiasaDashboardController extends Controller
{

    public function __invoke()
    {
        $data = KejadianLuarBiasaDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Kejadian Luar Biasa',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Kejadian Luar Biasa per Jenis KLB',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Total Penderita',
                        'data'  => $data['chart']['total_penderita'],
                    ],
                    [
                        'label' => 'Total Kematian',
                        'data'  => $data['chart']['total_kematian'],
                    ],
                    [
                        'label' => 'Attack Rate Total (%)',
                        'data'  => $data['chart']['attack_rate_total'],
                    ],
                    [
                        'label' => 'Case Fatality Rate (%)',
                        'data'  => $data['chart']['cfr_total'],
                    ],
                ],
            ],
        ]);
    }
}
