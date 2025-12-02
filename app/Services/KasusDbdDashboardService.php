<?php

namespace App\Services;

use App\Models\KasusDbd;

class KasusDbdDashboardService
{
    public static function getCards(): array
    {
        return [
            'total_kasus_l'     => KasusDbd::sum('kasus_l'),
            'total_kasus_p'     => KasusDbd::sum('kasus_p'),
            'total_kasus'       => KasusDbd::sum('kasus_total'),

            'total_meninggal_l' => KasusDbd::sum('meninggal_l'),
            'total_meninggal_p' => KasusDbd::sum('meninggal_p'),
            'total_meninggal'   => KasusDbd::sum('meninggal_total'),

            'rata_cfr_l'     => round((float) KasusDbd::avg('cfr_l_persen'), 2),
            'rata_cfr_p'     => round((float) KasusDbd::avg('cfr_p_persen'), 2),
            'rata_cfr_total' => round((float) KasusDbd::avg('cfr_total_persen'), 2),

            'angka_kesakitan_per100k' => (float) KasusDbd::avg('angka_kesakitan_per100k'),
        ];
    }

    public static function getChart(): array
    {
        $rows = KasusDbd::query()
            ->selectRaw('
                kecamatan,
                SUM(kasus_total) as total_kasus,
                SUM(meninggal_total) as total_meninggal,
                AVG(cfr_total_persen) as avg_cfr
            ')
            ->groupBy('kecamatan')
            ->orderBy('kecamatan')
            ->get();

        return [
            'labels'          => $rows->pluck('kecamatan')->toArray(),
            'kasus_total'     => $rows->pluck('total_kasus')->map(fn($v)=>(int)$v)->toArray(),
            'meninggal_total' => $rows->pluck('total_meninggal')->map(fn($v)=>(int)$v)->toArray(),
            'cfr_total'       => $rows->pluck('avg_cfr')->map(fn($v)=>(float)$v)->toArray(),
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
