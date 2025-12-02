<?php

namespace App\Services;

use App\Models\PelayananKesehatanUsiaProduktif;

class PelayananKesehatanUsiaProduktifDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview.
     */
    public static function getCards(): array
    {
        $totalPuskesmas = PelayananKesehatanUsiaProduktif::distinct('puskesmas')->count('puskesmas');

        $totalPendudukL  = PelayananKesehatanUsiaProduktif::sum('penduduk_l');
        $totalPendudukP  = PelayananKesehatanUsiaProduktif::sum('penduduk_p');
        $totalPenduduk   = PelayananKesehatanUsiaProduktif::sum('penduduk_total');

        $totalSkrining   = PelayananKesehatanUsiaProduktif::sum('skrining_total');
        $avgSkriningPct  = (float) PelayananKesehatanUsiaProduktif::avg('skrining_total_persen');

        $totalBerisiko   = PelayananKesehatanUsiaProduktif::sum('berisiko_total');
        $avgBerisikoPct  = (float) PelayananKesehatanUsiaProduktif::avg('berisiko_total_persen');

        return [
            'total_puskesmas'          => $totalPuskesmas,

            'total_penduduk_l'         => $totalPendudukL,
            'total_penduduk_p'         => $totalPendudukP,
            'total_penduduk'           => $totalPenduduk,

            'total_skrining'           => $totalSkrining,
            'rata_skrining_persen'     => round($avgSkriningPct, 1),

            'total_berisiko'           => $totalBerisiko,
            'rata_berisiko_persen'     => round($avgBerisikoPct, 1),
        ];
    }

    /**
     * Data untuk chart: skrining & berisiko per Puskesmas.
     */
    public static function getChart(): array
    {
        $rows = PelayananKesehatanUsiaProduktif::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get([
                'kecamatan',
                'puskesmas',
                'skrining_total_persen',
                'berisiko_total_persen',
            ]);

        $labels = $rows->map(function ($row) {
            return "{$row->puskesmas} ({$row->kecamatan})";
        })->toArray();

        return [
            'labels'               => $labels,
            'skrining_total_persen'=> $rows->pluck('skrining_total_persen')->map(fn ($v) => (float) $v)->toArray(),
            'berisiko_total_persen'=> $rows->pluck('berisiko_total_persen')->map(fn ($v) => (float) $v)->toArray(),
        ];
    }

    /**
     * Gabungan keduanya.
     */
    public static function getAll(): array
    {
        return [
            'cards' => self::getCards(),
            'chart' => self::getChart(),
        ];
    }
}
