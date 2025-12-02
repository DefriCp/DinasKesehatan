<?php

namespace App\Services;

use App\Models\PenderitaKronisFilariasis;

class PenderitaKronisFilariasisDashboardService
{
    public static function getCards(): array
    {
        return [
            'total_konfirmasi_sebelumnya' => PenderitaKronisFilariasis::sum('sebelumnya_total'),
            'total_konfirmasi_baru'       => PenderitaKronisFilariasis::sum('baru_total'),
            'total_pindah'                => PenderitaKronisFilariasis::sum('pindah_total'),
            'total_meninggal'             => PenderitaKronisFilariasis::sum('meninggal_total'),
            'total_semua'                 => PenderitaKronisFilariasis::sum('jumlah_total'),
        ];
    }

    public static function getChart(): array
    {
        $rows = PenderitaKronisFilariasis::query()
            ->selectRaw('
                kecamatan,
                SUM(sebelumnya_total) AS sebelumnya,
                SUM(baru_total) AS baru,
                SUM(pindah_total) AS pindah,
                SUM(meninggal_total) AS meninggal,
                SUM(jumlah_total) AS total
            ')
            ->groupBy('kecamatan')
            ->orderBy('kecamatan')
            ->get();

        return [
            'labels'    => $rows->pluck('kecamatan')->toArray(),
            'sebelumnya'=> $rows->pluck('sebelumnya')->map(fn ($v) => (int) $v)->toArray(),
            'baru'      => $rows->pluck('baru')->map(fn ($v) => (int) $v)->toArray(),
            'pindah'    => $rows->pluck('pindah')->map(fn ($v) => (int) $v)->toArray(),
            'meninggal' => $rows->pluck('meninggal')->map(fn ($v) => (int) $v)->toArray(),
            'total'     => $rows->pluck('total')->map(fn ($v) => (int) $v)->toArray(),
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
