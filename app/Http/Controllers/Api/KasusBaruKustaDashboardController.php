<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\KasusBaruKustaDashboardService;

class KasusBaruKustaDashboardController extends Controller
{
    /**
     * GET /api/v1/kasus-baru-kusta/dashboard
     *
     * Mengembalikan:
     *  - cards: ringkasan kasus PB, MB, total & NCDR kabupaten
     *  - chart: PB vs MB vs total kasus per puskesmas
     */
    public function __invoke()
    {
        $data = KasusBaruKustaDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Kasus Baru Kusta',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Distribusi Kasus PB & MB per Puskesmas',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Kasus PB',
                        'data'  => $data['chart']['pb_total'],
                    ],
                    [
                        'label' => 'Kasus MB',
                        'data'  => $data['chart']['mb_total'],
                    ],
                    [
                        'label' => 'Total Kasus',
                        'data'  => $data['chart']['total_kasus'],
                    ],
                ],
            ],
        ]);
    }
}
