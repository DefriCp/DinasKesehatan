<?php

namespace App\Filament\Resources\KejadianLuarBiasaResource\Widgets;

use App\Models\KejadianLuarBiasa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KlbStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalKejadian   = KejadianLuarBiasa::count();
        $totalPenderita  = KejadianLuarBiasa::sum('penderita_total');
        $totalKematian   = KejadianLuarBiasa::sum('kematian_total');

        $cfrTotal = $totalPenderita > 0
            ? round($totalKematian / $totalPenderita * 100, 1)
            : 0;

        $totalKeracunan = KejadianLuarBiasa::where('jenis_klb', 'like', '%Keracunan%')->count();
        $totalNonKeracunan = $totalKejadian - $totalKeracunan;

        return [
            Stat::make('Total kejadian KLB', $totalKejadian)
                ->description('Keracunan, Pertusis, HFMD, dll.')
                ->icon('heroicon-o-bell-alert'),

            Stat::make('Total penderita KLB', number_format($totalPenderita))
                ->description('Total kematian: ' . number_format($totalKematian))
                ->icon('heroicon-o-user-group'),

            Stat::make('CFR total', $cfrTotal . ' %')
                ->description('Kematian / penderita x 100')
                ->icon('heroicon-o-chart-pie'),

            Stat::make('KLB keracunan makanan', $totalKeracunan)
                ->description('Non-keracunan: ' . $totalNonKeracunan)
                ->icon('heroicon-o-fire'),
        ];
    }
}
