<?php

namespace App\Services;

use App\Models\DataTuberkulosis;

class DataTuberkulosisDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview TB.
     */
    public static function getCards(): array
    {
        $totalFaskes     = DataTuberkulosis::distinct('puskesmas')->count('puskesmas');

        $totalTerduga    = DataTuberkulosis::sum('jumlah_terduga_tb_pelayanan');

        $totalTbL        = DataTuberkulosis::sum('kasus_tb_laki_laki_jumlah');
        $totalTbP        = DataTuberkulosis::sum('kasus_tb_perempuan_jumlah');
        $totalTb         = DataTuberkulosis::sum('kasus_tb_total_jumlah');

        $totalTbAnak     = DataTuberkulosis::sum('kasus_tb_anak_0_14_jumlah');

        $avgTbLPercent   = (float) DataTuberkulosis::avg('kasus_tb_laki_laki_persen');
        $avgTbPPercent   = (float) DataTuberkulosis::avg('kasus_tb_perempuan_persen');

        return [
            'total_fasilitas'              => $totalFaskes,
            'total_terduga_tb_pelayanan'   => $totalTerduga,

            'total_kasus_tb_laki_laki'     => $totalTbL,
            'total_kasus_tb_perempuan'     => $totalTbP,
            'total_kasus_tb'               => $totalTb,

            'total_kasus_tb_anak_0_14'     => $totalTbAnak,

            'rata_kasus_tb_laki_laki_persen' => round($avgTbLPercent, 1),
            'rata_kasus_tb_perempuan_persen' => round($avgTbPPercent, 1),
        ];
    }

    /**
     * Data untuk chart: Total kasus TB & kasus TB anak per faskes.
     */
    public static function getChart(): array
    {
        $rows = DataTuberkulosis::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get([
                'kecamatan',
                'puskesmas',
                'kasus_tb_total_jumlah',
                'kasus_tb_anak_0_14_jumlah',
            ]);

        $labels = $rows->map(function ($row) {
            // Kalau kecamatan null (misal RSUD/RSIA), cukup tampilkan nama faskes
            return $row->kecamatan
                ? "{$row->puskesmas} ({$row->kecamatan})"
                : $row->puskesmas;
        })->toArray();

        return [
            'labels'           => $labels,
            'kasus_tb_total'   => $rows->pluck('kasus_tb_total_jumlah')->map(fn ($v) => (int) $v)->toArray(),
            'kasus_tb_anak_0_14' => $rows->pluck('kasus_tb_anak_0_14_jumlah')->map(fn ($v) => (int) $v)->toArray(),
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
