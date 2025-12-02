<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DeteksiHepatitisBumilDashboardService;

class DeteksiHepatitisBumilDashboardController extends Controller
{

    public function __invoke()
    {
        $data = DeteksiHepatitisBumilDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Deteksi Hepatitis pada Ibu Hamil',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Cakupan Pemeriksaan Hepatitis B pada Ibu Hamil per Puskesmas',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Bumil Diperiksa Hepatitis B (%)',
                        'data'  => $data['chart']['persen_bumil_diperiksa'],
                    ],
                    [
                        'label' => 'Bumil Reaktif (%)',
                        'data'  => $data['chart']['persen_bumil_reaktif'],
                    ],
                ],
            ],
        ]);
    }
}
