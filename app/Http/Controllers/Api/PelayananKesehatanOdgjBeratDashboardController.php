<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PelayananKesehatanOdgjBeratDashboardService;

class PelayananKesehatanOdgjBeratDashboardController extends Controller
{
    /**
     * GET /api/v1/pelayanan-kesehatan-odgj-berat/dashboard
     */
    public function __invoke()
    {
        $data = PelayananKesehatanOdgjBeratDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Pelayanan Kesehatan ODGJ Berat',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Pelayanan ODGJ Berat per Kecamatan',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Sasaran ODGJ Berat',
                        'data'  => $data['chart']['sasaran'],
                    ],
                    [
                        'label' => 'ODGJ Berat Mendapat Pelayanan',
                        'data'  => $data['chart']['pelayanan'],
                    ],
                    [
                        'label' => 'Capaian Pelayanan (%)',
                        'data'  => $data['chart']['pelayanan_persen'],
                    ],
                ],
            ],
        ]);
    }
}
