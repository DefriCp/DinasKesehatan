<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\KasusDiareDashboardService;

class KasusDiareDashboardController extends Controller
{

    public function __invoke()
    {
        $data = KasusDiareDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Kasus Diare',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Penemuan & Tata Laksana Diare Balita per Puskesmas',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Diare Balita Dilayani (%)',
                        'data'  => $data['chart']['diare_balita_persen'],
                    ],
                    [
                        'label' => 'Balita Mendapat Oralit (%)',
                        'data'  => $data['chart']['oralit_balita_persen'],
                    ],
                    [
                        'label' => 'Balita Mendapat Oralit + Zinc (%)',
                        'data'  => $data['chart']['oralit_zinc_balita_persen'],
                    ],
                ],
            ],
        ]);
    }
}
