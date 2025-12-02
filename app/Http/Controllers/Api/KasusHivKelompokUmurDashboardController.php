<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\KasusHivKelompokUmurDashboardService;

class KasusHivKelompokUmurDashboardController extends Controller
{

    public function __invoke()
    {
        $data = KasusHivKelompokUmurDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Kasus HIV menurut Kelompok Umur',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Distribusi Kasus HIV per Kelompok Umur',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Kasus HIV (Total)',
                        'data'  => $data['chart']['kasus_total'],
                    ],
                    [
                        'label' => 'Proporsi Kelompok Umur (%)',
                        'data'  => $data['chart']['proporsi_persen'],
                    ],
                ],
            ],
        ]);
    }
}
