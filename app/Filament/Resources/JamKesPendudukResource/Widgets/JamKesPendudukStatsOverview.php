<?php

namespace App\Filament\Resources\JamKesPendudukResource\Widgets;

use App\Models\JamKesPenduduk;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class JamKesPendudukStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Ringkasan Cakupan Jaminan Kesehatan';

    protected function getStats(): array
    {
        $totalPeserta = JamKesPenduduk::sum('jumlah');
        $totalPersen  = JamKesPenduduk::sum('persentase');

        return [
            Stat::make('Total Peserta (semua baris)', number_format($totalPeserta)),
            Stat::make('Akumulasi %', number_format($totalPersen, 1) . ' %'),
        ];
    }
}
