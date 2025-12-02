<?php

namespace App\Services;

use App\Models\CakupanPelayananKesehatanUsiaLanjut;

class CakupanPelayananKesehatanUsiaLanjutDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview.
     */
    public static function getCards(): array
    {
        $totalPuskesmas = CakupanPelayananKesehatanUsiaLanjut::distinct('puskesmas')->count('puskesmas');

        $totalLansiaL   = CakupanPelayananKesehatanUsiaLanjut::sum('lansia_laki_laki');
        $totalLansiaP   = CakupanPelayananKesehatanUsiaLanjut::sum('lansia_perempuan');
        $totalLansia    = CakupanPelayananKesehatanUsiaLanjut::sum('lansia_total');

        $totalSkrining  = CakupanPelayananKesehatanUsiaLanjut::sum('skrining_total_jumlah');
        $avgSkriningPct = (float) CakupanPelayananKesehatanUsiaLanjut::avg('skrining_total_persen');

        return [
            'total_puskesmas'      => $totalPuskesmas,

            'total_lansia_laki_laki' => $totalLansiaL,
            'total_lansia_perempuan' => $totalLansiaP,
            'total_lansia'           => $totalLansia,

            'total_skrining_lansia'  => $totalSkrining,
            'rata_skrining_persen'   => round($avgSkriningPct, 1),
        ];
    }

    /**
     * Data untuk chart: skrining lansia per Puskesmas (L/P/Total).
     */
    public static function getChart(): array
    {
        $rows = CakupanPelayananKesehatanUsiaLanjut::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get([
                'kecamatan',
                'puskesmas',
                'skrining_laki_laki_persen',
                'skrining_perempuan_persen',
                'skrining_total_persen',
            ]);

        $labels = $rows->map(function ($row) {
            return "{$row->puskesmas} ({$row->kecamatan})";
        })->toArray();

        return [
            'labels'                    => $labels,
            'skrining_laki_laki_persen' => $rows->pluck('skrining_laki_laki_persen')->map(fn ($v) => (float) $v)->toArray(),
            'skrining_perempuan_persen' => $rows->pluck('skrining_perempuan_persen')->map(fn ($v) => (float) $v)->toArray(),
            'skrining_total_persen'     => $rows->pluck('skrining_total_persen')->map(fn ($v) => (float) $v)->toArray(),
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
