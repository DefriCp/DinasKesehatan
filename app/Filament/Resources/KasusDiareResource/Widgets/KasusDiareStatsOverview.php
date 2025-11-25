<?php

namespace App\Filament\Resources\KasusDiareResource\Widgets;

use App\Models\KasusDiare;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KasusDiareStatsOverview extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalPenduduk      = KasusDiare::sum('jumlah_penduduk');
        $totalDiareDilayani = KasusDiare::sum('diare_dilayani_semua_jumlah');
        $totalTarget        = KasusDiare::sum('target_penemuan_semua_umur');

        $totalBalitaDilayani = KasusDiare::sum('diare_dilayani_balita_jumlah');
        $totalBalitaOralit   = KasusDiare::sum('oralit_balita_jumlah');
        $totalBalitaOralitZinc = KasusDiare::sum('oralit_zinc_balita_jumlah');

        // Angka kesakitan dihitung dari data
        $angkaKesakitanHitung = $totalPenduduk > 0
            ? round($totalDiareDilayani / $totalPenduduk * 1000, 1)
            : 0;

        // Cakupan diare dilayani vs target (semua umur)
        $cakupanPenemuan = $totalTarget > 0
            ? round($totalDiareDilayani / $totalTarget * 100, 1)
            : 0;

        // Cakupan balita mendapat oralit
        $cakupanOralitBalita = $totalBalitaDilayani > 0
            ? round($totalBalitaOralit / $totalBalitaDilayani * 100, 1)
            : 0;

        // Cakupan balita mendapat oralit + zinc
        $cakupanOralitZincBalita = $totalBalitaDilayani > 0
            ? round($totalBalitaOralitZinc / $totalBalitaDilayani * 100, 1)
            : 0;

        return [
            Stat::make('Total penduduk', number_format($totalPenduduk))
                ->description('Jumlah penduduk seluruh kecamatan')
                ->icon('heroicon-o-user-group'),

            Stat::make('Kasus diare dilayani', number_format($totalDiareDilayani))
                ->description('Semua umur')
                ->icon('heroicon-o-droplet'),

            Stat::make('Angka kesakitan diare', $angkaKesakitanHitung . ' / 1.000 penduduk')
                ->description('Dihitung dari kasus dilayani & penduduk')
                ->icon('heroicon-o-chart-bar'),

            Stat::make('Cakupan penemuan diare', $cakupanPenemuan . '%')
                ->description('Diare dilayani vs target (semua umur)')
                ->icon('heroicon-o-check-badge'),

            Stat::make('Balita mendapat oralit', number_format($totalBalitaOralit))
                ->description($cakupanOralitBalita . '% dari balita diare dilayani')
                ->icon('heroicon-o-sparkles'),

            Stat::make('Balita mendapat oralit + zinc', number_format($totalBalitaOralitZinc))
                ->description($cakupanOralitZincBalita . '% dari balita diare dilayani')
                ->icon('heroicon-o-sparkles'),
        ];
    }
}
