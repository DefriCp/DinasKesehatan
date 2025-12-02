<?php

namespace App\Services;

use App\Models\PelayananKesehatanOdgjBerat;

class PelayananKesehatanOdgjBeratDashboardService
{
    /**
     * Data kartu-kartu ringkasan ODGJ berat.
     */
    public static function getCards(): array
    {
        $totalSasaran    = PelayananKesehatanOdgjBerat::sum('sasaran_odgj_berat');

        $totalSkizo_0_14   = PelayananKesehatanOdgjBerat::sum('skizo_0_14');
        $totalSkizo_15_59  = PelayananKesehatanOdgjBerat::sum('skizo_15_59');
        $totalSkizo_60_plus= PelayananKesehatanOdgjBerat::sum('skizo_60_plus');
        $totalSkizo        = $totalSkizo_0_14 + $totalSkizo_15_59 + $totalSkizo_60_plus;

        $totalPsikotik_0_14   = PelayananKesehatanOdgjBerat::sum('psikotik_0_14');
        $totalPsikotik_15_59  = PelayananKesehatanOdgjBerat::sum('psikotik_15_59');
        $totalPsikotik_60_plus= PelayananKesehatanOdgjBerat::sum('psikotik_60_plus');
        $totalPsikotik        = $totalPsikotik_0_14 + $totalPsikotik_15_59 + $totalPsikotik_60_plus;

        $total0_14  = PelayananKesehatanOdgjBerat::sum('total_0_14');
        $total15_59 = PelayananKesehatanOdgjBerat::sum('total_15_59');
        $total60plus= PelayananKesehatanOdgjBerat::sum('total_60_plus');
        $totalDilayani = PelayananKesehatanOdgjBerat::sum('pelayanan_jumlah');

        $avgPelayananPct = (float) PelayananKesehatanOdgjBerat::avg('pelayanan_persen');

        return [
            'total_sasaran_odgj_berat'   => $totalSasaran,

            'total_skizo_0_14'           => $totalSkizo_0_14,
            'total_skizo_15_59'          => $totalSkizo_15_59,
            'total_skizo_60_plus'        => $totalSkizo_60_plus,
            'total_skizo'                => $totalSkizo,

            'total_psikotik_0_14'        => $totalPsikotik_0_14,
            'total_psikotik_15_59'       => $totalPsikotik_15_59,
            'total_psikotik_60_plus'     => $totalPsikotik_60_plus,
            'total_psikotik'             => $totalPsikotik,

            'total_dilayani_0_14'        => $total0_14,
            'total_dilayani_15_59'       => $total15_59,
            'total_dilayani_60_plus'     => $total60plus,
            'total_dilayani'             => $totalDilayani,

            'rata_pelayanan_persen'      => round($avgPelayananPct, 2),
        ];
    }

    /**
     * Chart: sasaran vs dilayani per kecamatan.
     */
    public static function getChart(): array
    {
        $rows = PelayananKesehatanOdgjBerat::query()
            ->selectRaw('
                kecamatan,
                SUM(sasaran_odgj_berat) AS sasaran,
                SUM(pelayanan_jumlah) AS pelayanan,
                AVG(pelayanan_persen) AS avg_pelayanan_persen
            ')
            ->groupBy('kecamatan')
            ->orderBy('kecamatan')
            ->get();

        return [
            'labels'            => $rows->pluck('kecamatan')->toArray(),
            'sasaran'           => $rows->pluck('sasaran')->map(fn ($v) => (int) $v)->toArray(),
            'pelayanan'         => $rows->pluck('pelayanan')->map(fn ($v) => (int) $v)->toArray(),
            'pelayanan_persen'  => $rows->pluck('avg_pelayanan_persen')->map(fn ($v) => (float) $v)->toArray(),
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
