<?php

namespace App\Filament\Resources\TtdIbuHamilResource\Widgets;

use App\Models\TtdIbuHamil;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TtdIbuHamilStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Ringkasan TTD Ibu Hamil';

    protected function getStats(): array
    {
        $total = TtdIbuHamil::sum('jumlah_ibu_hamil');
        $dapat = TtdIbuHamil::avg('dapat_ttd_persen');
        $konsum = TtdIbuHamil::avg('konsumsi_ttd_persen');

        return [
            Stat::make('Total Ibu Hamil', number_format($total)),
            Stat::make('Rata-rata Dapat TTD', number_format($dapat, 1) . '%'),
            Stat::make('Rata-rata Konsumsi TTD', number_format($konsum, 1) . '%'),
        ];
    }
}
