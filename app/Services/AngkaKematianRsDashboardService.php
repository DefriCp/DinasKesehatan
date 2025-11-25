<?php

namespace App\Services;

use App\Models\AngkaKematianRS;

class AngkaKematianRsDashboardService
{

    public static function getCards(): array
    {
        $totalRs           = AngkaKematianRS::count();
        $totalPasienKeluar = AngkaKematianRS::sum('pk_total');
        $totalMati         = AngkaKematianRS::sum('m_total');
        $totalMati48       = AngkaKematianRS::sum('m48_total');

        $avgGdr = (float) AngkaKematianRS::avg('gdr_total');
        $avgNdr = (float) AngkaKematianRS::avg('ndr_total');

        return [
            'total_rumah_sakit'      => $totalRs,
            'total_pasien_keluar'    => $totalPasienKeluar,
            'total_pasien_meninggal' => $totalMati,
            'total_meninggal_48_jam' => $totalMati48,
            'rata_rata_gdr'          => round($avgGdr, 2),
            'rata_rata_ndr'          => round($avgNdr, 2),
        ];
    }

    public static function getChart(): array
    {
        $data = AngkaKematianRS::query()
            ->orderBy('nama_rs')
            ->get(['nama_rs', 'gdr_total', 'ndr_total']);

        return [
            'labels' => $data->pluck('nama_rs')->toArray(),
            'gdr'    => $data->pluck('gdr_total')->map(fn ($v) => (float) $v)->toArray(),
            'ndr'    => $data->pluck('ndr_total')->map(fn ($v) => (float) $v)->toArray(),
        ];
    }

    public static function getAll(): array
    {
        return [
            'cards' => self::getCards(),
            'chart' => self::getChart(),
        ];
    }
}
