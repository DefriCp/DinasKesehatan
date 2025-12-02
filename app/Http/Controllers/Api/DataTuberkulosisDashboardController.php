<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DataTuberkulosisDashboardService;

class DataTuberkulosisDashboardController extends Controller
{

    public function __invoke()
    {
        $data = DataTuberkulosisDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Data Tuberkulosis',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Distribusi Kasus TB & TB Anak per Puskesmas/RS',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Kasus TB Total',
                        'data'  => $data['chart']['kasus_tb_total'],
                    ],
                    [
                        'label' => 'Kasus TB Anak 0–14',
                        'data'  => $data['chart']['kasus_tb_anak_0_14'],
                    ],
                ],
            ],
        ]);
    }
}
