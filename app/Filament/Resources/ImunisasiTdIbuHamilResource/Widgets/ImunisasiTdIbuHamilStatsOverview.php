<?php

namespace App\Filament\Resources\ImunisasiTdIbuHamilResource\Widgets;

use App\Models\ImunisasiTdIbuHamil;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ImunisasiTdIbuHamilStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Ringkasan Imunisasi Td Ibu Hamil';

    protected function getStats(): array
    {
        $totalIbuHamil = ImunisasiTdIbuHamil::sum('jumlah_ibu_hamil');
        $totalTd2Plus  = ImunisasiTdIbuHamil::sum('td2_plus');
        $avgTd2Plus    = ImunisasiTdIbuHamil::avg('td2_plus_persen');

        return [
            Stat::make('Total Ibu Hamil', number_format($totalIbuHamil)),
            Stat::make('Total Td2+', number_format($totalTd2Plus)),
            Stat::make('Rata-rata Td2+ (%)', number_format($avgTd2Plus, 1) . ' %'),
        ];
    }
}
