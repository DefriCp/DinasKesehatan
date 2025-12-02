<?php

namespace App\Services;

use App\Models\KasusBaruKusta;

class KasusBaruKustaDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview Kasus Baru Kusta.
     */
    public static function getCards(): array
    {
        $totalPuskesmas = KasusBaruKusta::distinct('puskesmas')->count('puskesmas');

        $totalPbL       = KasusBaruKusta::sum('pb_l');
        $totalPbP       = KasusBaruKusta::sum('pb_p');
        $totalPb        = KasusBaruKusta::sum('pb_total');

        $totalMbL       = KasusBaruKusta::sum('mb_l');
        $totalMbP       = KasusBaruKusta::sum('mb_p');
        $totalMb        = KasusBaruKusta::sum('mb_total');

        $totalL         = KasusBaruKusta::sum('total_l');
        $totalP         = KasusBaruKusta::sum('total_p');
        $totalKasus     = KasusBaruKusta::sum('total_kasus');

        $avgNcdrL       = (float) KasusBaruKusta::avg('ncdr_l_per100k');
        $avgNcdrP       = (float) KasusBaruKusta::avg('ncdr_p_per100k');
        $avgNcdrTotal   = (float) KasusBaruKusta::avg('ncdr_total_per100k');

        return [
            'total_puskesmas'           => $totalPuskesmas,

            'total_pb_l'                => $totalPbL,
            'total_pb_p'                => $totalPbP,
            'total_pb'                  => $totalPb,

            'total_mb_l'                => $totalMbL,
            'total_mb_p'                => $totalMbP,
            'total_mb'                  => $totalMb,

            'total_kasus_l'             => $totalL,
            'total_kasus_p'             => $totalP,
            'total_kasus'               => $totalKasus,

            'rata_ncdr_l_per100k'       => round($avgNcdrL, 2),
            'rata_ncdr_p_per100k'       => round($avgNcdrP, 2),
            'rata_ncdr_total_per100k'   => round($avgNcdrTotal, 2),
        ];
    }

    /**
     * Data untuk chart: PB vs MB vs Total per puskesmas.
     */
    public static function getChart(): array
    {
        $rows = KasusBaruKusta::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get([
                'kecamatan',
                'puskesmas',
                'pb_total',
                'mb_total',
                'total_kasus',
            ]);

        $labels = $rows->map(function ($row) {
            return "{$row->puskesmas} ({$row->kecamatan})";
        })->toArray();

        return [
            'labels'      => $labels,
            'pb_total'    => $rows->pluck('pb_total')->map(fn ($v) => (int) $v)->toArray(),
            'mb_total'    => $rows->pluck('mb_total')->map(fn ($v) => (int) $v)->toArray(),
            'total_kasus' => $rows->pluck('total_kasus')->map(fn ($v) => (int) $v)->toArray(),
        ];
    }

    /**
     * Gabungan untuk API.
     */
    public static function getAll(): array
    {
        return [
            'cards' => self::getCards(),
            'chart' => self::getChart(),
        ];
    }
}
