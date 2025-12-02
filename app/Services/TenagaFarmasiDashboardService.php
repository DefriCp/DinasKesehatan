<?php

namespace App\Services;

use App\Models\TenagaFarmasi;

class TenagaFarmasiDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview Tenaga Farmasi.
     */
    public static function getCards(): array
    {
        $totalUnitKerja = TenagaFarmasi::count();

        $totalTtk       = TenagaFarmasi::sum('ttk_total');
        $totalApoteker  = TenagaFarmasi::sum('apoteker_total');
        $totalFarmasi   = TenagaFarmasi::sum('total_total');

        return [
            'total_unit_kerja'   => $totalUnitKerja,
            'ttk_total'          => $totalTtk,
            'apoteker_total'     => $totalApoteker,
            'total_tenaga_farmasi' => $totalFarmasi,
        ];
    }

    /**
     * Data untuk chart: TTK vs Apoteker vs Total per unit kerja.
     */
    public static function getChart(): array
    {
        $rows = TenagaFarmasi::query()
            ->orderBy('unit_kerja')
            ->get(['unit_kerja', 'ttk_total', 'apoteker_total', 'total_total']);

        return [
            'labels'            => $rows->pluck('unit_kerja')->toArray(),
            'ttk_total'         => $rows->pluck('ttk_total')->map(fn ($v) => (int) $v)->toArray(),
            'apoteker_total'    => $rows->pluck('apoteker_total')->map(fn ($v) => (int) $v)->toArray(),
            'total_total'       => $rows->pluck('total_total')->map(fn ($v) => (int) $v)->toArray(),
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
