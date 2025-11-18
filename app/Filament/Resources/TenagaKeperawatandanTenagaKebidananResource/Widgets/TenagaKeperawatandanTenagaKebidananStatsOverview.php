<?php

namespace App\Filament\Resources\TenagaKeperawatandanTenagaKebidananResource\Widgets;

use App\Models\TenagaKeperawatandanTenagaKebidanan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TenagaKeperawatandanTenagaKebidananStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Ringkasan Tenaga Keperawatan & Kebidanan';

    protected function getStats(): array
    {
        $totalUnit    = TenagaKeperawatandanTenagaKebidanan::count();
        $totalPerL    = TenagaKeperawatandanTenagaKebidanan::sum('perawat_l');
        $totalPerP    = TenagaKeperawatandanTenagaKebidanan::sum('perawat_p');
        $totalPerawat = TenagaKeperawatandanTenagaKebidanan::sum('perawat_total');
        $totalBidan   = TenagaKeperawatandanTenagaKebidanan::sum('bidan_total');

        return [
            Stat::make('Total Unit Kerja', $totalUnit)
                ->description('Puskesmas, RS, & lainnya'),

            Stat::make('Perawat L', $totalPerL)
                ->description('Tenaga keperawatan laki-laki'),

            Stat::make('Perawat P', $totalPerP)
                ->description('Tenaga keperawatan perempuan'),

            Stat::make('Total Perawat', $totalPerawat)
                ->description('Perawat L + P'),

            Stat::make('Total Bidan', $totalBidan)
                ->description('Tenaga kebidanan'),
        ];
    }
}
