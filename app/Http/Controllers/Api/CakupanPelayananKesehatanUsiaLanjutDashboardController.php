<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CakupanPelayananKesehatanUsiaLanjutDashboardService;

class CakupanPelayananKesehatanUsiaLanjutDashboardController extends Controller
{

    public function __invoke()
    {
        $data = CakupanPelayananKesehatanUsiaLanjutDashboardService::getAll();

        return response()->json([
            'status'  => 'ok',
            'message' => 'Dashboard Cakupan Pelayanan Kesehatan Usia Lanjut',
            'cards'   => $data['cards'],
            'chart'   => [
                'title'   => 'Cakupan Skrining Kesehatan Lansia per Puskesmas',
                'labels'  => $data['chart']['labels'],
                'datasets'=> [
                    [
                        'label' => 'Skrining Lansia Laki-laki (%)',
                        'data'  => $data['chart']['skrining_laki_laki_persen'],
                    ],
                    [
                        'label' => 'Skrining Lansia Perempuan (%)',
                        'data'  => $data['chart']['skrining_perempuan_persen'],
                    ],
                    [
                        'label' => 'Skrining Lansia Total (%)',
                        'data'  => $data['chart']['skrining_total_persen'],
                    ],
                ],
            ],
        ]);
    }
}
