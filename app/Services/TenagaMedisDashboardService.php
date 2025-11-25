<?php

namespace App\Services;

use App\Models\TenagaMedis;

class TenagaMedisDashboardService
{

    public static function getCards(): array
    {
        $totalUnitKerja   = TenagaMedis::count();

        $totalSpesialis   = TenagaMedis::sum('sp_total');
        $totalDokterUmum  = TenagaMedis::sum('dr_total');
        $totalDokter      = TenagaMedis::sum('dokter_total');

        $totalGigi        = TenagaMedis::sum('gigi_total');
        $totalGigiSpes    = TenagaMedis::sum('gigis_total');
        $totalDokterGigi  = TenagaMedis::sum('jumlah_gigi_total');

        return [
            'total_unit_kerja'  => $totalUnitKerja,
            'dokter_spesialis'  => $totalSpesialis,
            'dokter_umum'       => $totalDokterUmum,
            'total_dokter'      => $totalDokter,
            'dokter_gigi'       => $totalGigi,
            'dokter_gigi_spes'  => $totalGigiSpes,
            'total_dokter_gigi' => $totalDokterGigi,
        ];
    }

    public static function getChart(): array
    {
        $data = TenagaMedis::query()
            ->orderBy('unit_kerja')
            ->get(['unit_kerja', 'dokter_total', 'jumlah_gigi_total']);

        return [
            'labels'        => $data->pluck('unit_kerja')->toArray(),
            'total_dokter'  => $data->pluck('dokter_total')->map(fn ($v) => (int) $v)->toArray(),
            'total_dokter_gigi' => $data->pluck('jumlah_gigi_total')->map(fn ($v) => (int) $v)->toArray(),
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
