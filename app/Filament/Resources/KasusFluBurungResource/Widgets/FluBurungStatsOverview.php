<?php

namespace App\Filament\Resources\KasusFluBurungResource\Widgets;

use App\Models\KasusFluBurung;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FluBurungStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalKasus     = KasusFluBurung::sum('kasus_total');
        $totalKematian  = KasusFluBurung::sum('kematian_total');

        $cfr = $totalKasus > 0
            ? round($totalKematian / $totalKasus * 100, 1)
            : 0;

        return [
            Stat::make('Total Kasus Flu Burung', number_format($totalKasus))
                ->description('Akumulasi semua puskesmas')
                ->icon('heroicon-o-bug-ant'),

            Stat::make('Total Kematian', number_format($totalKematian))
                ->description('Seluruh kabupaten/kota')
                ->icon('heroicon-o-x-circle'),

            Stat::make('CFR Kab/Kota', $totalKasus > 0 ? $cfr . ' %' : '-')
                ->description('Case Fatality Rate')
                ->icon('heroicon-o-chart-pie'),
        ];
    }
}
