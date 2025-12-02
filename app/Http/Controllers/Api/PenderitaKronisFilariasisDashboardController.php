<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PenderitaKronisFilariasisDashboardService;

class PenderitaKronisFilariasisDashboardController extends Controller
{
    public function __invoke()
    {
        $data = PenderitaKronisFilariasisDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Penderita Kronis Filariasis',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Distribusi Filariasis Kronis per Kecamatan',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Kasus Sebelumnya',
                        'data'  => $data['chart']['sebelumnya'],
                    ],
                    [
                        'label' => 'Kasus Baru',
                        'data'  => $data['chart']['baru'],
                    ],
                    [
                        'label' => 'Pindah',
                        'data'  => $data['chart']['pindah'],
                    ],
                    [
                        'label' => 'Meninggal',
                        'data'  => $data['chart']['meninggal'],
                    ],
                    [
                        'label' => 'Total Kasus Kronis',
                        'data'  => $data['chart']['total'],
                    ],
                ],
            ],
        ]);
    }
}
