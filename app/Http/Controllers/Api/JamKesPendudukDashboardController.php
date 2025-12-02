<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\JamKesPendudukDashboardService;

class JamKesPendudukDashboardController extends Controller
{
    public function __invoke()
    {
        $data = JamKesPendudukDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Jaminan Kesehatan Penduduk',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Distribusi Kepesertaan Jaminan Kesehatan Penduduk',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Jumlah Peserta',
                        'data'  => $data['chart']['jumlah'],
                    ],
                    [
                        'label' => 'Persentase Kepesertaan (%)',
                        'data'  => $data['chart']['persentase'],
                    ],
                ],
            ],
        ]);
    }
}
