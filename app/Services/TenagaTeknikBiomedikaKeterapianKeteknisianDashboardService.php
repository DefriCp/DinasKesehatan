<?php

namespace App\Services;

use App\Models\TenagaTeknikBiomedikaKeterapianKeteknisian;

class TenagaTeknikBiomedikaKeterapianKeteknisianDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview.
     */
    public static function getCards(): array
    {
        $totalUnitKerja = TenagaTeknikBiomedikaKeterapianKeteknisian::count();

        $totalAtl        = TenagaTeknikBiomedikaKeterapianKeteknisian::sum('atl_total');
        $totalBiomedika  = TenagaTeknikBiomedikaKeterapianKeteknisian::sum('biomedika_total');
        $totalKeterapian = TenagaTeknikBiomedikaKeterapianKeteknisian::sum('keterapian_total');
        $totalKeteknisian = TenagaTeknikBiomedikaKeterapianKeteknisian::sum('keteknisian_total');

        return [
            'total_unit_kerja' => $totalUnitKerja,
            'atl_total'        => $totalAtl,
            'biomedika_total'  => $totalBiomedika,
            'keterapian_total' => $totalKeterapian,
            'keteknisian_total'=> $totalKeteknisian,
        ];
    }

    /**
     * Data untuk chart: masing-masing kategori per unit kerja.
     */
    public static function getChart(): array
    {
        $rows = TenagaTeknikBiomedikaKeterapianKeteknisian::query()
            ->orderBy('unit_kerja')
            ->get([
                'unit_kerja',
                'atl_total',
                'biomedika_total',
                'keterapian_total',
                'keteknisian_total',
            ]);

        return [
            'labels'            => $rows->pluck('unit_kerja')->toArray(),
            'atl_total'         => $rows->pluck('atl_total')->map(fn ($v) => (int) $v)->toArray(),
            'biomedika_total'   => $rows->pluck('biomedika_total')->map(fn ($v) => (int) $v)->toArray(),
            'keterapian_total'  => $rows->pluck('keterapian_total')->map(fn ($v) => (int) $v)->toArray(),
            'keteknisian_total' => $rows->pluck('keteknisian_total')->map(fn ($v) => (int) $v)->toArray(),
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
