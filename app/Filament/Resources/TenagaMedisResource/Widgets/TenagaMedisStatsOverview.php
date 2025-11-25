<?php

namespace App\Filament\Resources\TenagaMedisResource\Widgets;

use App\Services\TenagaMedisDashboardService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class TenagaMedisStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $cards = TenagaMedisDashboardService::getCards();

        return [
            Card::make('Total Unit Kerja', $cards['total_unit_kerja'])
                ->description('Puskesmas, RS, & lainnya'),

            Card::make('Dokter Spesialis', $cards['dokter_spesialis'])
                ->description('Total Spesialis'),

            Card::make('Dokter Umum', $cards['dokter_umum'])
                ->description('Total Dokter Umum'),

            Card::make('Total Dokter', $cards['total_dokter'])
                ->description('Spesialis + Umum'),

            Card::make('Dokter Gigi', $cards['dokter_gigi'])
                ->description('Umum'),

            Card::make('Dokter Gigi Spesialis', $cards['dokter_gigi_spes'])
                ->description('Spesialis'),

            Card::make('Total Dokter Gigi', $cards['total_dokter_gigi'])
                ->description('Gigi Umum + Spesialis'),
        ];
    }
}
