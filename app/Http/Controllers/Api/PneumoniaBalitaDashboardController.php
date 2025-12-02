<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PneumoniaBalitaDashboardService;

class PneumoniaBalitaDashboardController extends Controller
{

    public function __invoke()
    {
        $data = PneumoniaBalitaDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Pneumonia Balita',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Tatalaksana Batuk & Penemuan Pneumonia pada Balita per Puskesmas',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Balita Batuk Ditatalaksana (%)',
                        'data'  => $data['chart']['batuk_tatalaksana_persen'],
                    ],
                    [
                        'label' => 'Penemuan Pneumonia (%)',
                        'data'  => $data['chart']['penemuan_pneumonia_persen'],
                    ],
                ],
            ],
        ]);
    }
}
