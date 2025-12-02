<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TtdIbuHamilDashboardService;

class TtdIbuHamilDashboardController extends Controller
{

    public function __invoke()
    {
        $data = TtdIbuHamilDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard TTD Ibu Hamil',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Cakupan Pemberian & Konsumsi TTD per Puskesmas',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Mendapat TTD (%)',
                        'data'  => $data['chart']['dapat_ttd_persen'],
                    ],
                    [
                        'label' => 'Konsumsi TTD (%)',
                        'data'  => $data['chart']['konsumsi_ttd_persen'],
                    ],
                ],
            ],
        ]);
    }
}
