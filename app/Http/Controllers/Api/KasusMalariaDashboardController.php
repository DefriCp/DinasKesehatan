<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\KasusMalariaDashboardService;

class KasusMalariaDashboardController extends Controller
{
    /**
     * GET /api/v1/kasus-malaria/dashboard
     */
    public function __invoke()
    {
        $data = KasusMalariaDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Kasus Malaria',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Suspek, Konfirmasi & Pengobatan Malaria per Kecamatan',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Total Suspek',
                        'data'  => $data['chart']['total_suspek'],
                    ],
                    [
                        'label' => 'Total Kasus Terkonfirmasi',
                        'data'  => $data['chart']['total_konfirmasi'],
                    ],
                    [
                        'label' => 'Konfirmasi Lab (%)',
                        'data'  => $data['chart']['konfirmasi_persen'],
                    ],
                    [
                        'label' => 'Pengobatan Standar (%)',
                        'data'  => $data['chart']['pengobatan_persen'],
                    ],
                ],
            ],
        ]);
    }
}
