<?php

namespace App\Filament\Resources\DeteksiHepatitisBumilResource\Widgets;

use App\Models\DeteksiHepatitisBumil;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DeteksiHepatitisBumilStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalBumil        = DeteksiHepatitisBumil::sum('jumlah_ibu_hamil');
        $totalDiperiksa    = DeteksiHepatitisBumil::sum('ibu_hamil_diperiksa_total');
        $totalReaktif      = DeteksiHepatitisBumil::sum('ibu_hamil_diperiksa_reaktif');

        $persenDiperiksa = $totalBumil > 0
            ? round($totalDiperiksa / $totalBumil * 100, 1)
            : 0;

        $persenReaktif = $totalDiperiksa > 0
            ? round($totalReaktif / $totalDiperiksa * 100, 1)
            : 0;

        return [
            Stat::make('Jumlah ibu hamil', number_format($totalBumil))
                ->description('Total sasaran bumil di kab/kota')
                ->icon('heroicon-o-user-group'),

            Stat::make('Bumil diperiksa Hepatitis B', number_format($totalDiperiksa))
                ->description($persenDiperiksa . '% dari seluruh bumil')
                ->icon('heroicon-o-clipboard-document-check'),

            Stat::make('Bumil reaktif Hepatitis B', number_format($totalReaktif))
                ->description($persenReaktif . '% dari bumil yang diperiksa')
                ->icon('heroicon-o-exclamation-triangle'),
        ];
    }
}
