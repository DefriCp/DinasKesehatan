<?php

namespace App\Services;

use App\Models\PelayananKesehatanIbu;

class PelayananKesehatanIbuDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview Pelayanan Kesehatan Ibu.
     */
    public static function getCards(): array
    {
        $totalPuskesmas    = PelayananKesehatanIbu::distinct('puskesmas')->count('puskesmas');

        $totalIbuHamil     = PelayananKesehatanIbu::sum('ibu_hamil_jumlah');
        $totalIbuBersalin  = PelayananKesehatanIbu::sum('ibu_bersalin_jumlah');

        $avgK1             = (float) PelayananKesehatanIbu::avg('k1_persen');
        $avgK4             = (float) PelayananKesehatanIbu::avg('k4_persen');
        $avgPersalinanFasy = (float) PelayananKesehatanIbu::avg('persalinan_fasyankes_persen');

        return [
            'total_puskesmas'               => $totalPuskesmas,
            'total_ibu_hamil'               => $totalIbuHamil,
            'total_ibu_bersalin'            => $totalIbuBersalin,
            'rata_rata_k1_persen'           => round($avgK1, 1),
            'rata_rata_k4_persen'           => round($avgK4, 1),
            'rata_rata_persalinan_fasyankes'=> round($avgPersalinanFasy, 1),
        ];
    }

    /**
     * Data untuk chart: K1 / K4 / K6 per Puskesmas (dalam persentase).
     */
    public static function getChart(): array
    {
        $rows = PelayananKesehatanIbu::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get([
                'kecamatan',
                'puskesmas',
                'k1_persen',
                'k4_persen',
                'k6_persen',
            ]);

        // Label pakai "Puskesmas (Kecamatan)"
        $labels = $rows->map(function ($row) {
            return "{$row->puskesmas} ({$row->kecamatan})";
        })->toArray();

        return [
            'labels'     => $labels,
            'k1_persen'  => $rows->pluck('k1_persen')->map(fn ($v) => (float) $v)->toArray(),
            'k4_persen'  => $rows->pluck('k4_persen')->map(fn ($v) => (float) $v)->toArray(),
            'k6_persen'  => $rows->pluck('k6_persen')->map(fn ($v) => (float) $v)->toArray(),
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
