<?php

namespace App\Filament\Resources\KasusDbdResource\Widgets;

use App\Models\KasusDbd;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KasusDbdStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalKasus     = KasusDbd::sum('kasus_total');
        $totalMeninggal = KasusDbd::sum('meninggal_total');

        $cfrTotal = $totalKasus > 0
            ? round($totalMeninggal / $totalKasus * 100, 1)
            : 0;

        // Ambil angka kesakitan tertinggi (kab/kota)
        $angkaKesakitan = KasusDbd::whereNotNull('angka_kesakitan_per100k')
            ->max('angka_kesakitan_per100k');

        return [
            Stat::make('Total kasus DBD', number_format($totalKasus))
                ->description('Semua puskesmas')
                ->icon('heroicon-o-bug-ant'),

            Stat::make('Total kematian DBD', number_format($totalMeninggal))
                ->description('CFR total: ' . $cfrTotal . ' %')
                ->icon('heroicon-o-heart'),

            Stat::make('Angka kesakitan DBD', $angkaKesakitan !== null ? $angkaKesakitan . ' / 100.000 penduduk' : '-')
                ->description('Diisi dari rekap kab/kota (mis: 40,1)')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}
