<?php

namespace App\Filament\Resources\KasusBaruKustaResource\Widgets;

use App\Models\KasusBaruKusta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KasusBaruKustaStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalPbL   = KasusBaruKusta::sum('pb_l');
        $totalPbP   = KasusBaruKusta::sum('pb_p');
        $totalPb    = KasusBaruKusta::sum('pb_total');

        $totalMbL   = KasusBaruKusta::sum('mb_l');
        $totalMbP   = KasusBaruKusta::sum('mb_p');
        $totalMb    = KasusBaruKusta::sum('mb_total');

        $totalL     = KasusBaruKusta::sum('total_l');
        $totalP     = KasusBaruKusta::sum('total_p');
        $totalKasus = KasusBaruKusta::sum('total_kasus');

        $proporsiL = $totalKasus > 0 ? round($totalL / $totalKasus * 100, 1) : 0;
        $proporsiP = $totalKasus > 0 ? round($totalP / $totalKasus * 100, 1) : 0;

        $ncdrTotal = KasusBaruKusta::whereNotNull('ncdr_total_per100k')->max('ncdr_total_per100k');

        return [
            Stat::make('Total kasus PB', number_format($totalPb))
                ->description('L: ' . $totalPbL . ' | P: ' . $totalPbP)
                ->icon('heroicon-o-sparkles'),

            Stat::make('Total kasus MB', number_format($totalMb))
                ->description('L: ' . $totalMbL . ' | P: ' . $totalMbP)
                ->icon('heroicon-o-fire'),

            Stat::make('Total kasus baru kusta', number_format($totalKasus))
                ->description('L ' . $proporsiL . '% | P ' . $proporsiP . '%')
                ->icon('heroicon-o-finger-print'),

            Stat::make('NCDR total', $ncdrTotal !== null ? $ncdrTotal . ' / 100.000' : '-')
                ->description('Diisi manual pada salah satu baris jika diperlukan')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}
