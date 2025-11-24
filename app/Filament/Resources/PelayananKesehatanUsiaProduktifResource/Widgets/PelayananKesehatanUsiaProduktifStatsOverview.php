<?php

namespace App\Filament\Resources\PelayananKesehatanUsiaProduktifResource\Widgets;

use App\Models\PelayananKesehatanUsiaProduktif;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PelayananKesehatanUsiaProduktifStatsOverview extends BaseWidget
{
    // PERHATIKAN: TIDAK STATIC
    protected ?string $heading = 'Ringkasan Pelayanan Kesehatan Usia Produktif';

    protected function getStats(): array
    {
        $totalPenduduk = PelayananKesehatanUsiaProduktif::sum('penduduk_total');
        $totalSkrining = PelayananKesehatanUsiaProduktif::sum('skrining_total_jumlah');
        $totalBerisiko = PelayananKesehatanUsiaProduktif::sum('berisiko_total_jumlah');

        $cakupanSkrining = $totalPenduduk > 0
            ? round($totalSkrining / $totalPenduduk * 100, 1)
            : 0;

        $proporsiBerisiko = $totalSkrining > 0
            ? round($totalBerisiko / $totalSkrining * 100, 1)
            : 0;

        return [
            Stat::make('Penduduk usia 15–59 tahun', number_format($totalPenduduk))
                ->description('Total populasi usia produktif')
                ->icon('heroicon-o-user-group'),

            Stat::make('Mendapat skrining', number_format($totalSkrining))
                ->description($cakupanSkrining . '% dari penduduk usia produktif')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->icon('heroicon-o-heart'),

            Stat::make('Kasus berisiko', number_format($totalBerisiko))
                ->description($proporsiBerisiko . '% dari yang diskrining')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning')
                ->icon('heroicon-o-exclamation-triangle'),
        ];
    }
}
