<?php

namespace App\Services;

use App\Models\TenagaKesmasKeslingdanGizi;

class TenagaKesmasKeslingdanGiziDashboardService
{
    /**
     * Data untuk kartu-kartu stats overview.
     */
    public static function getCards(): array
    {
        $totalUnitKerja = TenagaKesmasKeslingdanGizi::count();

        $totalKesmas    = TenagaKesmasKeslingdanGizi::sum('kesmas_total');
        $totalKesling   = TenagaKesmasKeslingdanGizi::sum('kesling_total');
        $totalGizi      = TenagaKesmasKeslingdanGizi::sum('gizi_total');

        return [
            'total_unit_kerja' => $totalUnitKerja,
            'kesmas_total'     => $totalKesmas,
            'kesling_total'    => $totalKesling,
            'gizi_total'       => $totalGizi,
        ];
    }

    /**
     * Data untuk chart: Kesmas vs Kesling vs Gizi per unit kerja.
     */
    public static function getChart(): array
    {
        $rows = TenagaKesmasKeslingdanGizi::query()
            ->orderBy('unit_kerja')
            ->get(['unit_kerja', 'kesmas_total', 'kesling_total', 'gizi_total']);

        return [
            'labels'        => $rows->pluck('unit_kerja')->toArray(),
            'kesmas_total'  => $rows->pluck('kesmas_total')->map(fn ($v) => (int) $v)->toArray(),
            'kesling_total' => $rows->pluck('kesling_total')->map(fn ($v) => (int) $v)->toArray(),
            'gizi_total'    => $rows->pluck('gizi_total')->map(fn ($v) => (int) $v)->toArray(),
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
