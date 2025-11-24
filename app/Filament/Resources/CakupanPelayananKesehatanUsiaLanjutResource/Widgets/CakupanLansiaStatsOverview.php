<?php

namespace App\Filament\Resources\CakupanPelayananKesehatanUsiaLanjutResource\Widgets;

use App\Models\CakupanPelayananKesehatanUsiaLanjut;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CakupanLansiaStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false; 
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalLansia   = CakupanPelayananKesehatanUsiaLanjut::sum('lansia_total');
        $totalSkrining = CakupanPelayananKesehatanUsiaLanjut::sum('skrining_total_jumlah');

        $avgCakupan = CakupanPelayananKesehatanUsiaLanjut::query()
            ->whereNotNull('skrining_total_persen')
            ->avg('skrining_total_persen');

        return [
            Stat::make('Total Lansia 60+', number_format($totalLansia))
                ->description('Penduduk usia ≥ 60 tahun')
                ->icon('heroicon-o-user-group'),

            Stat::make('Lansia telah diskrining', number_format($totalSkrining))
                ->description('Jumlah L + P')
                ->icon('heroicon-o-clipboard-document-check'),

            Stat::make('Rata-rata cakupan skrining', ($avgCakupan ? number_format($avgCakupan, 1) . '%' : '-'))
                ->description('Rata-rata seluruh kecamatan/puskesmas')
                ->icon('heroicon-o-chart-pie'),
        ];
    }
}
