<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ImunisasiTdIbuHamilDashboardService;

class ImunisasiTdIbuHamilDashboardController extends Controller
{

    public function __invoke()
    {
        $data = ImunisasiTdIbuHamilDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Imunisasi TD Ibu Hamil',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Cakupan Imunisasi TD1–TD5 & TD2+ per Puskesmas',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'TD1 (%)',
                        'data'  => $data['chart']['td1_persen'],
                    ],
                    [
                        'label' => 'TD2 (%)',
                        'data'  => $data['chart']['td2_persen'],
                    ],
                    [
                        'label' => 'TD3 (%)',
                        'data'  => $data['chart']['td3_persen'],
                    ],
                    [
                        'label' => 'TD4 (%)',
                        'data'  => $data['chart']['td4_persen'],
                    ],
                    [
                        'label' => 'TD5 (%)',
                        'data'  => $data['chart']['td5_persen'],
                    ],
                    [
                        'label' => 'TD2+ (%)',
                        'data'  => $data['chart']['td2_plus_persen'],
                    ],
                ],
            ],
        ]);
    }
}
