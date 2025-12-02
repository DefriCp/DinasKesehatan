<?php

namespace App\Services;

use App\Models\PelayananKesehatanHipertensi;

class PelayananKesehatanHipertensiDashboardService
{
    public static function getCards(): array
    {
        return [
            'total_estimasi'            => PelayananKesehatanHipertensi::sum('estimasi_total'),
            'total_pelayanan_l'         => PelayananKesehatanHipertensi::sum('pelayanan_l_jumlah'),
            'total_pelayanan_p'         => PelayananKesehatanHipertensi::sum('pelayanan_p_jumlah'),
            'total_pelayanan'           => PelayananKesehatanHipertensi::sum('pelayanan_total_jumlah'),

            'rata_pelayanan_l_persen'   => round((float) PelayananKesehatanHipertensi::avg('pelayanan_l_persen'), 2),
            'rata_pelayanan_p_persen'   => round((float) PelayananKesehatanHipertensi::avg('pelayanan_p_persen'), 2),
            'rata_pelayanan_total_persen' => round((float) PelayananKesehatanHipertensi::avg('pelayanan_total_persen'), 2),
        ];
    }

    public static function getChart(): array
    {
        $rows = PelayananKesehatanHipertensi::query()
            ->selectRaw('
                kecamatan,
                SUM(pelayanan_l_jumlah) AS pelayanan_l,
                SUM(pelayanan_p_jumlah) AS pelayanan_p,
                SUM(pelayanan_total_jumlah) AS pelayanan_total,
                AVG(pelayanan_total_persen) AS pelayanan_total_persen
            ')
            ->groupBy('kecamatan')
            ->orderBy('kecamatan')
            ->get();

        return [
            'labels'         => $rows->pluck('kecamatan')->toArray(),
            'pelayanan_l'    => $rows->pluck('pelayanan_l')->map(fn($v)=>(int)$v)->toArray(),
            'pelayanan_p'    => $rows->pluck('pelayanan_p')->map(fn($v)=>(int)$v)->toArray(),
            'pelayanan_total'=> $rows->pluck('pelayanan_total')->map(fn($v)=>(int)$v)->toArray(),
            'pelayanan_total_persen' => $rows->pluck('pelayanan_total_persen')->map(fn($v)=>(float)$v)->toArray(),
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
