<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TenagaFarmasiDashboardService;

class TenagaFarmasiDashboardController extends Controller
{
    /**
     * GET /api/v1/tenaga-farmasi/dashboard
     *
     * Mengembalikan:
     *  - cards: ringkasan TTK, Apoteker, total tenaga farmasi
     *  - chart: perbandingan per unit kerja
     */
    public function __invoke()
    {
        $data = TenagaFarmasiDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Tenaga Farmasi',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'TTK, Apoteker, dan Total Tenaga Farmasi per Unit Kerja',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'TTK (Total)',
                        'data'  => $data['chart']['ttk_total'],
                    ],
                    [
                        'label' => 'Apoteker (Total)',
                        'data'  => $data['chart']['apoteker_total'],
                    ],
                    [
                        'label' => 'Total Tenaga Farmasi',
                        'data'  => $data['chart']['total_total'],
                    ],
                ],
            ],
        ]);
    }
}
