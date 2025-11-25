<?php

namespace App\Filament\Resources\KasusMalariaResource\Widgets;

use App\Models\KasusMalaria;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KasusMalariaStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalSuspek      = KasusMalaria::sum('suspek');
        $totalKonfirmasi  = KasusMalaria::sum('konfirmasi_total');
        $totalPositif     = KasusMalaria::sum('positif_total');
        $totalDiobati     = KasusMalaria::sum('pengobatan_total');
        $totalMeninggal   = KasusMalaria::sum('meninggal_total');

        $persenKonfirmasi = $totalSuspek > 0
            ? round($totalKonfirmasi / $totalSuspek * 100, 1)
            : 0;

        $persenPengobatan = $totalPositif > 0
            ? round($totalDiobati / $totalPositif * 100, 1)
            : 0;

        $cfrTotal = $totalPositif > 0
            ? round($totalMeninggal / $totalPositif * 100, 2)
            : 0;

        $api = KasusMalaria::whereNotNull('api_per1000')->max('api_per1000');

        return [
            Stat::make('Total suspek malaria', number_format($totalSuspek))
                ->description('Konfirmasi lab: ' . number_format($totalKonfirmasi) . ' (' . $persenKonfirmasi . '%)')
                ->icon('heroicon-o-beaker'),

            Stat::make('Kasus positif malaria', number_format($totalPositif))
                ->description('Diobati standar: ' . number_format($totalDiobati) . ' (' . $persenPengobatan . '%)')
                ->icon('heroicon-o-check-circle'),

            Stat::make('Kematian & CFR', number_format($totalMeninggal) . ' jiwa')
                ->description('CFR total: ' . $cfrTotal . ' %')
                ->icon('heroicon-o-heart'),

            Stat::make('API Malaria', $api !== null ? $api . ' /1.000 penduduk' : '-')
                ->description('Annual Parasite Incidence kab/kota')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}
