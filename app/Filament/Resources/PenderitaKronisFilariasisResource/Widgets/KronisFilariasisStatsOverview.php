<?php

namespace App\Filament\Resources\PenderitaKronisFilariasisResource\Widgets;

use App\Models\PenderitaKronisFilariasis;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KronisFilariasisStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalSebelumnya = PenderitaKronisFilariasis::sum('sebelumnya_total');
        $totalBaru       = PenderitaKronisFilariasis::sum('baru_total');
        $totalMeninggal  = PenderitaKronisFilariasis::sum('meninggal_total');
        $totalJumlah     = PenderitaKronisFilariasis::sum('jumlah_total');

        return [
            Stat::make('Kronis tahun sebelumnya', number_format($totalSebelumnya))
                ->description('Akumulasi semua puskesmas')
                ->icon('heroicon-o-clock'),

            Stat::make('Kronis baru ditemukan', number_format($totalBaru))
                ->description('Kasus kronis baru tahun berjalan')
                ->icon('heroicon-o-sparkles'),

            Stat::make('Meninggal karena kronis', number_format($totalMeninggal))
                ->description('Dari seluruh kasus kronis')
                ->icon('heroicon-o-heart'),

            Stat::make('Total seluruh kasus kronis', number_format($totalJumlah))
                ->description('Saat ini tercatat')
                ->icon('heroicon-o-finger-print'),
        ];
    }
}
