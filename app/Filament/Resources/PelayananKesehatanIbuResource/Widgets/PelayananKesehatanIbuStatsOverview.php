<?php

namespace App\Filament\Resources\PelayananKesehatanIbuResource\Widgets;

use App\Models\PelayananKesehatanIbu;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PelayananKesehatanIbuStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Ringkasan Cakupan Pelayanan Ibu';

    protected function getStats(): array
    {
        $totalIbuHamil    = PelayananKesehatanIbu::sum('ibu_hamil_jumlah');
        $totalIbuBersalin = PelayananKesehatanIbu::sum('ibu_bersalin_jumlah');

        $avgK1   = PelayananKesehatanIbu::avg('k1_persen');
        $avgK4   = PelayananKesehatanIbu::avg('k4_persen');
        $avgFaskes = PelayananKesehatanIbu::avg('persalinan_fasyankes_persen');

        return [
            Stat::make('Total Ibu Hamil', number_format($totalIbuHamil)),
            Stat::make('Total Ibu Bersalin/Nifas', number_format($totalIbuBersalin)),
            Stat::make('Rata-rata K1', number_format($avgK1, 1) . ' %'),
            Stat::make('Rata-rata K4', number_format($avgK4, 1) . ' %'),
            Stat::make('Rata-rata Persalinan di Fasyankes', number_format($avgFaskes, 1) . ' %'),
        ];
    }
}
