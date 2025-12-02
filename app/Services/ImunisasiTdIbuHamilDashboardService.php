<?php

namespace App\Services;

use App\Models\ImunisasiTdIbuHamil;

class ImunisasiTdIbuHamilDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview Imunisasi TD Ibu Hamil.
     */
    public static function getCards(): array
    {
        $totalPuskesmas   = ImunisasiTdIbuHamil::distinct('puskesmas')->count('puskesmas');
        $totalIbuHamil    = ImunisasiTdIbuHamil::sum('jumlah_ibu_hamil');

        $avgTd1           = (float) ImunisasiTdIbuHamil::avg('td1_persen');
        $avgTd2           = (float) ImunisasiTdIbuHamil::avg('td2_persen');
        $avgTd3           = (float) ImunisasiTdIbuHamil::avg('td3_persen');
        $avgTd4           = (float) ImunisasiTdIbuHamil::avg('td4_persen');
        $avgTd5           = (float) ImunisasiTdIbuHamil::avg('td5_persen');
        $avgTd2Plus       = (float) ImunisasiTdIbuHamil::avg('td2_plus_persen');

        return [
            'total_puskesmas'      => $totalPuskesmas,
            'total_ibu_hamil'      => $totalIbuHamil,

            'rata_td1_persen'      => round($avgTd1, 1),
            'rata_td2_persen'      => round($avgTd2, 1),
            'rata_td3_persen'      => round($avgTd3, 1),
            'rata_td4_persen'      => round($avgTd4, 1),
            'rata_td5_persen'      => round($avgTd5, 1),
            'rata_td2_plus_persen' => round($avgTd2Plus, 1),
        ];
    }

    /**
     * Data untuk chart: persentase TD1–TD5 & TD2+ per Puskesmas.
     */
    public static function getChart(): array
    {
        $rows = ImunisasiTdIbuHamil::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get([
                'kecamatan',
                'puskesmas',
                'td1_persen',
                'td2_persen',
                'td3_persen',
                'td4_persen',
                'td5_persen',
                'td2_plus_persen',
            ]);

        $labels = $rows->map(function ($row) {
            return "{$row->puskesmas} ({$row->kecamatan})";
        })->toArray();

        return [
            'labels'           => $labels,
            'td1_persen'       => $rows->pluck('td1_persen')->map(fn ($v) => (float) $v)->toArray(),
            'td2_persen'       => $rows->pluck('td2_persen')->map(fn ($v) => (float) $v)->toArray(),
            'td3_persen'       => $rows->pluck('td3_persen')->map(fn ($v) => (float) $v)->toArray(),
            'td4_persen'       => $rows->pluck('td4_persen')->map(fn ($v) => (float) $v)->toArray(),
            'td5_persen'       => $rows->pluck('td5_persen')->map(fn ($v) => (float) $v)->toArray(),
            'td2_plus_persen'  => $rows->pluck('td2_plus_persen')->map(fn ($v) => (float) $v)->toArray(),
        ];
    }

    /**
     * Gabungan keduanya (praktis untuk API).
     */
    public static function getAll(): array
    {
        return [
            'cards' => self::getCards(),
            'chart' => self::getChart(),
        ];
    }
}
