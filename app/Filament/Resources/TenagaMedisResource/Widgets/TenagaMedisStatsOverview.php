<?php

namespace App\Filament\Resources\TenagaMedisResource\Widgets;

use App\Models\TenagaMedis;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class TenagaMedisStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $totalUnitKerja   = TenagaMedis::count();

        $totalSpesialis   = TenagaMedis::sum('sp_total');
        $totalDokterUmum  = TenagaMedis::sum('dr_total');
        $totalDokter      = TenagaMedis::sum('dokter_total');

        $totalGigi        = TenagaMedis::sum('gigi_total');
        $totalGigiSpes    = TenagaMedis::sum('gigis_total');
        $totalDokterGigi  = TenagaMedis::sum('jumlah_gigi_total');

        return [
            Card::make('Total Unit Kerja', $totalUnitKerja)
                ->description('Puskesmas, RS, & lainnya'),

            Card::make('Dokter Spesialis', $totalSpesialis)
                ->description('Total Spesialis'),

            Card::make('Dokter Umum', $totalDokterUmum)
                ->description('Total Dokter Umum'),

            Card::make('Total Dokter', $totalDokter)
                ->description('Spesialis + Umum'),

            Card::make('Dokter Gigi', $totalGigi)
                ->description('Umum'),

            Card::make('Dokter Gigi Spesialis', $totalGigiSpes)
                ->description('Spesialis'),

            Card::make('Total Dokter Gigi', $totalDokterGigi)
                ->description('Gigi Umum + Spesialis'),
        ];
    }
}
