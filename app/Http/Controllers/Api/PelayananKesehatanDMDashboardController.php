<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PelayananKesehatanDMDashboardService;

class PelayananKesehatanDMDashboardController extends Controller
{
    /**
     * GET /api/v1/pelayanan-kesehatan-dm/dashboard
     */
    public function __invoke()
    {
        $data = PelayananKesehatanDMDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Pelayanan Kesehatan DM',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Pelayanan DM per Kecamatan',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Jumlah Penderita DM',
                        'data'  => $data['chart']['total_penderita'],
                    ],
                    [
                        'label' => 'Penderita Mendapat Pelayanan',
                        'data'  => $data['chart']['total_pelayanan'],
                    ],
                    [
                        'label' => 'Cakupan Pelayanan (%)',
                        'data'  => $data['chart']['pelayanan_persen'],
                    ],
                ],
            ],
        ]);
    }
}
