<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AngkaKematianRsDashboardService;

class AngkaKematianRsDashboardController extends Controller
{
    public function __invoke()
    {
        $data = AngkaKematianRsDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Angka Kematian Rumah Sakit',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'GDR & NDR per Rumah Sakit',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'GDR (%)',
                        'data'  => $data['chart']['gdr'],
                    ],
                    [
                        'label' => 'NDR (%)',
                        'data'  => $data['chart']['ndr'],
                    ],
                ],
            ],
        ]);
    }
}
