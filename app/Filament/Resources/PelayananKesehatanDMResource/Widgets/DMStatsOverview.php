<?php

namespace App\Filament\Resources\PelayananKesehatanDMResource\Widgets;

use App\Models\PelayananKesehatanDM;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DMStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalPenderita = PelayananKesehatanDM::sum('jumlah_penderita_dm');
        $totalDilayani  = PelayananKesehatanDM::sum('pelayanan_jumlah');

        $cakupan = $totalPenderita > 0
            ? round($totalDilayani / $totalPenderita * 100, 1)
            : 0;

        return [
            Stat::make('Penderita DM tercatat', number_format($totalPenderita))
                ->description('Total di semua puskesmas')
                ->icon('heroicon-o-user-group'),

            Stat::make('Penderita DM dilayani', number_format($totalDilayani))
                ->description('Cakupan: ' . $cakupan . ' %')
                ->icon('heroicon-o-heart'),

            Stat::make('Gap belum terlayani', number_format(max($totalPenderita - $totalDilayani, 0)))
                ->description('Perlu dipantau di program PTM')
                ->icon('heroicon-o-exclamation-circle'),
        ];
    }
}
