<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PelayananKesehatanHipertensiDashboardService;

class PelayananKesehatanHipertensiDashboardController extends Controller
{
    public function __invoke()
    {
        $data = PelayananKesehatanHipertensiDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Pelayanan Kesehatan Hipertensi',
            'cards'   => $data['cards'],

            'chart' => [
                'title'   => 'Pelayanan Hipertensi per Kecamatan',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Pelayanan Laki-laki',
                        'data'  => $data['chart']['pelayanan_l'],
                    ],
                    [
                        'label' => 'Pelayanan Perempuan',
                        'data'  => $data['chart']['pelayanan_p'],
                    ],
                    [
                        'label' => 'Pelayanan Total',
                        'data'  => $data['chart']['pelayanan_total'],
                    ],
                    [
                        'label' => 'Capaian Pelayanan (%)',
                        'data'  => $data['chart']['pelayanan_total_persen'],
                    ],
                ],
            ],
        ]);
    }
}
