<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TenagaKeperawatandanTenagaKebidananDashboardService;

class TenagaKeperawatandanTenagaKebidananDashboardController extends Controller
{

    public function __invoke()
    {
        $data = TenagaKeperawatandanTenagaKebidananDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Tenaga Keperawatan dan Tenaga Kebidanan',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Perawat & Bidan per Unit Kerja',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Perawat (Total)',
                        'data'  => $data['chart']['perawat_total'],
                    ],
                    [
                        'label' => 'Bidan (Total)',
                        'data'  => $data['chart']['bidan_total'],
                    ],
                ],
            ],
        ]);
    }
}
