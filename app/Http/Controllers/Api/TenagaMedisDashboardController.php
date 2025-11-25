<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TenagaMedisDashboardService;

class TenagaMedisDashboardController extends Controller
{
    public function __invoke()
    {
        $data = TenagaMedisDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Tenaga Medis',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Distribusi Tenaga Medis per Unit Kerja',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Total Dokter',
                        'data'  => $data['chart']['total_dokter'],
                    ],
                    [
                        'label' => 'Total Dokter Gigi',
                        'data'  => $data['chart']['total_dokter_gigi'],
                    ],
                ],
            ],
        ]);
    }
}
