<?php

namespace App\Services;

use App\Models\PneumoniaBalita;

class PneumoniaBalitaDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview Pneumonia Balita.
     */
    public static function getCards(): array
    {
        $totalPuskesmas = PneumoniaBalita::distinct('puskesmas')->count('puskesmas');

        $totalBalita          = PneumoniaBalita::sum('jumlah_balita');

        $totalBatukKunjungan  = PneumoniaBalita::sum('balita_batuk_kunjungan');
        $totalBatukTtl        = PneumoniaBalita::sum('balita_batuk_tatalaksana_l')
                               + PneumoniaBalita::sum('balita_batuk_tatalaksana_p');
        $avgBatukTatalaksana  = (float) PneumoniaBalita::avg('balita_batuk_tatalaksana_persen');

        $totalPerkiraanPneu   = PneumoniaBalita::sum('perkiraan_pneumonia_balita');

        $totalPneuL           = PneumoniaBalita::sum('pneumonia_l');
        $totalPneuP           = PneumoniaBalita::sum('pneumonia_p');
        $totalPneuBeratL      = PneumoniaBalita::sum('pneumonia_berat_l');
        $totalPneuBeratP      = PneumoniaBalita::sum('pneumonia_berat_p');

        $totalPneuTotal       = PneumoniaBalita::sum('jumlah_pneumonia_total');
        $avgPenemuanPneuPct   = (float) PneumoniaBalita::avg('penemuan_pneumonia_persen');

        $totalBatukNonPneu    = PneumoniaBalita::sum('batuk_non_pneumonia_total');

        return [
            'total_puskesmas'                 => $totalPuskesmas,

            'total_balita'                    => $totalBalita,

            'total_balita_batuk_kunjungan'    => $totalBatukKunjungan,
            'total_balita_batuk_tatalaksana'  => $totalBatukTtl,
            'rata_tatalaksana_batuk_persen'   => round($avgBatukTatalaksana, 1),

            'total_perkiraan_pneumonia_balita'=> $totalPerkiraanPneu,

            'total_pneumonia_tidak_berat_l'   => $totalPneuL,
            'total_pneumonia_tidak_berat_p'   => $totalPneuP,
            'total_pneumonia_berat_l'         => $totalPneuBeratL,
            'total_pneumonia_berat_p'         => $totalPneuBeratP,

            'total_pneumonia_semua'           => $totalPneuTotal,
            'rata_penemuan_pneumonia_persen'  => round($avgPenemuanPneuPct, 1),

            'total_batuk_non_pneumonia'       => $totalBatukNonPneu,
        ];
    }

    /**
     * Data untuk chart: tatalaksana batuk & penemuan pneumonia per puskesmas (dalam %).
     */
    public static function getChart(): array
    {
        $rows = PneumoniaBalita::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get([
                'kecamatan',
                'puskesmas',
                'balita_batuk_tatalaksana_persen',
                'penemuan_pneumonia_persen',
            ]);

        $labels = $rows->map(function ($row) {
            return "{$row->puskesmas} ({$row->kecamatan})";
        })->toArray();

        return [
            'labels'                        => $labels,
            'batuk_tatalaksana_persen'      => $rows->pluck('balita_batuk_tatalaksana_persen')->map(fn ($v) => (float) $v)->toArray(),
            'penemuan_pneumonia_persen'     => $rows->pluck('penemuan_pneumonia_persen')->map(fn ($v) => (float) $v)->toArray(),
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
