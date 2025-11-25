<?php

namespace App\Filament\Resources\PelayananKesehatanHipertensiResource\Widgets;

use App\Models\PelayananKesehatanHipertensi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HipertensiStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalEstimasi   = PelayananKesehatanHipertensi::sum('estimasi_total');
        $totalDilayani   = PelayananKesehatanHipertensi::sum('pelayanan_total_jumlah');
        $totalDilayaniL  = PelayananKesehatanHipertensi::sum('pelayanan_l_jumlah');
        $totalDilayaniP  = PelayananKesehatanHipertensi::sum('pelayanan_p_jumlah');

        $cakupanTotal = $totalEstimasi > 0
            ? round($totalDilayani / $totalEstimasi * 100, 1)
            : 0;

        $cakupanL = $totalEstimasi > 0
            ? round($totalDilayaniL / $totalEstimasi * 100, 1)
            : 0;

        $cakupanP = $totalEstimasi > 0
            ? round($totalDilayaniP / $totalEstimasi * 100, 1)
            : 0;

        return [
            Stat::make('Estimasi penderita hipertensi', number_format($totalEstimasi))
                ->description('Usia ≥ 15 tahun, seluruh puskesmas')
                ->icon('heroicon-o-user-group'),

            Stat::make('Total dilayani', number_format($totalDilayani))
                ->description('Cakupan: ' . $cakupanTotal . ' %')
                ->icon('heroicon-o-heart'),

            Stat::make('Dilayani L / P', number_format($totalDilayaniL) . ' L | ' . number_format($totalDilayaniP) . ' P')
                ->description('Perkiraan L: ' . $cakupanL . ' % • P: ' . $cakupanP . ' %')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}
