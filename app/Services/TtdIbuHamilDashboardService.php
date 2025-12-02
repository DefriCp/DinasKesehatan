<?php

namespace App\Services;

use App\Models\TtdIbuHamil;

class TtdIbuHamilDashboardService
{

    public static function getCards(): array
    {
        $totalPuskesmas = TtdIbuHamil::distinct('puskesmas')->count('puskesmas');
        $totalIbuHamil  = TtdIbuHamil::sum('jumlah_ibu_hamil');

        $totalDapatTtd  = TtdIbuHamil::sum('dapat_ttd');
        $totalKonsumsi  = TtdIbuHamil::sum('konsumsi_ttd');

        $avgDapatTtd    = (float) TtdIbuHamil::avg('dapat_ttd_persen');
        $avgKonsumsi    = (float) TtdIbuHamil::avg('konsumsi_ttd_persen');

        return [
            'total_puskesmas'           => $totalPuskesmas,
            'total_ibu_hamil'           => $totalIbuHamil,
            'total_dapat_ttd'           => $totalDapatTtd,
            'total_konsumsi_ttd'        => $totalKonsumsi,
            'rata_dapat_ttd_persen'     => round($avgDapatTtd, 1),
            'rata_konsumsi_ttd_persen'  => round($avgKonsumsi, 1),
        ];
    }

    /**
     * Data untuk chart: persentase dapat TTD & konsumsi TTD per puskesmas.
     */
    public static function getChart(): array
    {
        $rows = TtdIbuHamil::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get([
                'kecamatan',
                'puskesmas',
                'dapat_ttd_persen',
                'konsumsi_ttd_persen',
            ]);

        $labels = $rows->map(function ($row) {
            return "{$row->puskesmas} ({$row->kecamatan})";
        })->toArray();

        return [
            'labels'                => $labels,
            'dapat_ttd_persen'      => $rows->pluck('dapat_ttd_persen')->map(fn ($v) => (float) $v)->toArray(),
            'konsumsi_ttd_persen'   => $rows->pluck('konsumsi_ttd_persen')->map(fn ($v) => (float) $v)->toArray(),
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
