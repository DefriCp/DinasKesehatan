<?php

namespace App\Filament\Resources\PneumoniaBalitaResource\Widgets;

use App\Models\PneumoniaBalita;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PneumoniaBalitaStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalBalita          = PneumoniaBalita::sum('jumlah_balita');
        $totalBatukKunjungan  = PneumoniaBalita::sum('balita_batuk_kunjungan');
        $totalTatalaksanaL    = PneumoniaBalita::sum('balita_batuk_tatalaksana_l');
        $totalTatalaksanaP    = PneumoniaBalita::sum('balita_batuk_tatalaksana_p');
        $totalTatalaksana     = $totalTatalaksanaL + $totalTatalaksanaP;

        $totalPerkiraanPn     = PneumoniaBalita::sum('perkiraan_pneumonia_balita');
        $totalKasusPn         = PneumoniaBalita::sum('jumlah_pneumonia_total');

        $cakupanTatalaksana = $totalBatukKunjungan > 0
            ? round($totalTatalaksana / $totalBatukKunjungan * 100, 1)
            : 0;

        $cakupanPenemuanPn = $totalPerkiraanPn > 0
            ? round($totalKasusPn / $totalPerkiraanPn * 100, 1)
            : 0;

        return [
            Stat::make('Total balita', number_format($totalBalita))
                ->description('Jumlah balita di semua wilayah')
                ->icon('heroicon-o-user-group'),

            Stat::make('Balita batuk / sesak', number_format($totalBatukKunjungan))
                ->description('Jumlah kunjungan batuk / kesukaran napas')
                ->icon('heroicon-o-cloud'),

            Stat::make('Cakupan tatalaksana standar', number_format($cakupanTatalaksana, 1) . '%')
                ->description('Dari semua kunjungan batuk / sesak')
                ->icon('heroicon-o-check-badge'),

            Stat::make('Perkiraan pneumonia balita', number_format($totalPerkiraanPn))
                ->description('Total perkiraan kasus di kab/kota')
                ->icon('heroicon-o-exclamation-triangle'),

            Stat::make('Kasus pneumonia ditemukan', number_format($totalKasusPn))
                ->description('Kasus pneumonia (L+P)')
                ->icon('heroicon-o-chart-bar'),

            Stat::make('Cakupan penemuan pneumonia', number_format($cakupanPenemuanPn, 1) . '%')
                ->description('Dari total perkiraan pneumonia')
                ->icon('heroicon-o-chart-pie'),
        ];
    }
}
