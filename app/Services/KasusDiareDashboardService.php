<?php

namespace App\Services;

use App\Models\KasusDiare;

class KasusDiareDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview Kasus Diare.
     */
    public static function getCards(): array
    {
        $totalPuskesmas = KasusDiare::distinct('puskesmas')->count('puskesmas');
        $totalPenduduk  = KasusDiare::sum('jumlah_penduduk');

        $targetSemua    = KasusDiare::sum('target_penemuan_semua_umur');
        $targetBalita   = KasusDiare::sum('target_penemuan_balita');

        $diareSemua     = KasusDiare::sum('diare_dilayani_semua_jumlah');
        $diareBalita    = KasusDiare::sum('diare_dilayani_balita_jumlah');

        $avgDiareSemuaPct  = (float) KasusDiare::avg('diare_dilayani_semua_persen');
        $avgDiareBalitaPct = (float) KasusDiare::avg('diare_dilayani_balita_persen');

        $oralitSemua    = KasusDiare::sum('oralit_semua_jumlah');
        $oralitBalita   = KasusDiare::sum('oralit_balita_jumlah');

        $zincBalita     = KasusDiare::sum('zinc_balita_jumlah');
        $oralitZincBalita = KasusDiare::sum('oralit_zinc_balita_jumlah');

        $avgOralitBalitaPct   = (float) KasusDiare::avg('oralit_balita_persen');
        $avgZincBalitaPct     = (float) KasusDiare::avg('zinc_balita_persen');
        $avgOralitZincBalitaPct = (float) KasusDiare::avg('oralit_zinc_balita_persen');

        $avgKesakitanSemua   = (float) KasusDiare::avg('angka_kesakitan_semua_per1000');
        $avgKesakitanBalita  = (float) KasusDiare::avg('angka_kesakitan_balita_per1000');

        return [
            'total_puskesmas'                 => $totalPuskesmas,
            'total_penduduk'                  => $totalPenduduk,

            'total_target_penemuan_semua_umur'=> $targetSemua,
            'total_target_penemuan_balita'    => $targetBalita,

            'total_diare_dilayani_semua'      => $diareSemua,
            'total_diare_dilayani_balita'     => $diareBalita,
            'rata_diare_dilayani_semua_persen'=> round($avgDiareSemuaPct, 1),
            'rata_diare_dilayani_balita_persen'=> round($avgDiareBalitaPct, 1),

            'total_oralit_semua'              => $oralitSemua,
            'total_oralit_balita'             => $oralitBalita,
            'total_zinc_balita'               => $zincBalita,
            'total_oralit_zinc_balita'        => $oralitZincBalita,
            'rata_oralit_balita_persen'       => round($avgOralitBalitaPct, 1),
            'rata_zinc_balita_persen'         => round($avgZincBalitaPct, 1),
            'rata_oralit_zinc_balita_persen'  => round($avgOralitZincBalitaPct, 1),

            'rata_angka_kesakitan_semua_per1000'  => round($avgKesakitanSemua, 2),
            'rata_angka_kesakitan_balita_per1000' => round($avgKesakitanBalita, 2),
        ];
    }

    /**
     * Data untuk chart: diare balita & oralit+zinc balita per puskesmas (dalam %).
     */
    public static function getChart(): array
    {
        $rows = KasusDiare::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get([
                'kecamatan',
                'puskesmas',
                'diare_dilayani_balita_persen',
                'oralit_balita_persen',
                'oralit_zinc_balita_persen',
            ]);

        $labels = $rows->map(function ($row) {
            return "{$row->puskesmas} ({$row->kecamatan})";
        })->toArray();

        return [
            'labels'                    => $labels,
            'diare_balita_persen'       => $rows->pluck('diare_dilayani_balita_persen')->map(fn ($v) => (float) $v)->toArray(),
            'oralit_balita_persen'      => $rows->pluck('oralit_balita_persen')->map(fn ($v) => (float) $v)->toArray(),
            'oralit_zinc_balita_persen' => $rows->pluck('oralit_zinc_balita_persen')->map(fn ($v) => (float) $v)->toArray(),
        ];
    }

    /**
     * Gabungan keduanya (untuk API).
     */
    public static function getAll(): array
    {
        return [
            'cards' => self::getCards(),
            'chart' => self::getChart(),
        ];
    }
}
