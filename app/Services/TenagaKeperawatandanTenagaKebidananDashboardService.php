<?php

namespace App\Services;

use App\Models\TenagaKeperawatandanTenagaKebidanan;

class TenagaKeperawatandanTenagaKebidananDashboardService
{

    public static function getCards(): array
    {
        $totalUnitKerja = TenagaKeperawatandanTenagaKebidanan::count();

        $totalPerawatL  = TenagaKeperawatandanTenagaKebidanan::sum('perawat_l');
        $totalPerawatP  = TenagaKeperawatandanTenagaKebidanan::sum('perawat_p');
        $totalPerawat   = TenagaKeperawatandanTenagaKebidanan::sum('perawat_total');

        $totalBidan     = TenagaKeperawatandanTenagaKebidanan::sum('bidan_total');

        return [
            'total_unit_kerja' => $totalUnitKerja,

            'perawat_l'        => $totalPerawatL,
            'perawat_p'        => $totalPerawatP,
            'perawat_total'    => $totalPerawat,

            'bidan_total'      => $totalBidan,
        ];
    }

    public static function getChart(): array
    {
        $rows = TenagaKeperawatandanTenagaKebidanan::query()
            ->orderBy('unit_kerja')
            ->get(['unit_kerja', 'perawat_total', 'bidan_total']);

        return [
            'labels'        => $rows->pluck('unit_kerja')->toArray(),
            'perawat_total' => $rows->pluck('perawat_total')->map(fn ($v) => (int) $v)->toArray(),
            'bidan_total'   => $rows->pluck('bidan_total')->map(fn ($v) => (int) $v)->toArray(),
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
