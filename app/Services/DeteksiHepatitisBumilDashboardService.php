<?php

namespace App\Services;

use App\Models\DeteksiHepatitisBumil;

class DeteksiHepatitisBumilDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview Deteksi Hepatitis pada Ibu Hamil.
     */
    public static function getCards(): array
    {
        $totalPuskesmas = DeteksiHepatitisBumil::distinct('puskesmas')->count('puskesmas');

        $totalBumil     = DeteksiHepatitisBumil::sum('jumlah_ibu_hamil');

        $totalDiperiksa = DeteksiHepatitisBumil::sum('ibu_hamil_diperiksa_total');
        $totalReaktif   = DeteksiHepatitisBumil::sum('ibu_hamil_diperiksa_reaktif');
        $totalNonReaktif= DeteksiHepatitisBumil::sum('ibu_hamil_diperiksa_nonreaktif');

        $avgPeriksaPct  = (float) DeteksiHepatitisBumil::avg('persen_bumil_diperiksa');
        $avgReaktifPct  = (float) DeteksiHepatitisBumil::avg('persen_bumil_reaktif');

        return [
            'total_puskesmas'             => $totalPuskesmas,

            'total_ibu_hamil'            => $totalBumil,
            'total_ibu_hamil_diperiksa'  => $totalDiperiksa,
            'total_ibu_hamil_reaktif'    => $totalReaktif,
            'total_ibu_hamil_nonreaktif' => $totalNonReaktif,

            'rata_persen_bumil_diperiksa'=> round($avgPeriksaPct, 1),
            'rata_persen_bumil_reaktif'  => round($avgReaktifPct, 1),
        ];
    }

    /**
     * Data untuk chart: % bumil diperiksa & % reaktif per puskesmas.
     */
    public static function getChart(): array
    {
        $rows = DeteksiHepatitisBumil::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get([
                'kecamatan',
                'puskesmas',
                'persen_bumil_diperiksa',
                'persen_bumil_reaktif',
            ]);

        $labels = $rows->map(function ($row) {
            return "{$row->puskesmas} ({$row->kecamatan})";
        })->toArray();

        return [
            'labels'                => $labels,
            'persen_bumil_diperiksa'=> $rows->pluck('persen_bumil_diperiksa')->map(fn ($v) => (float) $v)->toArray(),
            'persen_bumil_reaktif'  => $rows->pluck('persen_bumil_reaktif')->map(fn ($v) => (float) $v)->toArray(),
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
