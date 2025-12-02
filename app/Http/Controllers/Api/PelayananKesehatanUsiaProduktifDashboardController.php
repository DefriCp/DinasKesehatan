<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PelayananKesehatanUsiaProduktifDashboardService;

class PelayananKesehatanUsiaProduktifDashboardController extends Controller
{
    /**
     * GET /api/v1/pelayanan-kesehatan-usia-produktif/dashboard
     */
    public function __invoke()
    {
        $data = PelayananKesehatanUsiaProduktifDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Pelayanan Kesehatan Usia Produktif',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Skrining & Penduduk Berisiko Usia Produktif per Puskesmas',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Skrining Total (%)',
                        'data'  => $data['chart']['skrining_total_persen'],
                    ],
                    [
                        'label' => 'Berisiko Total (%)',
                        'data'  => $data['chart']['berisiko_total_persen'],
                    ],
                ],
            ],
        ]);
    }
}
