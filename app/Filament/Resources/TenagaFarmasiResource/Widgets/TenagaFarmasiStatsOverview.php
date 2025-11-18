<?php

namespace App\Filament\Resources\TenagaFarmasiResource\Widgets;

use App\Models\TenagaFarmasi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TenagaFarmasiStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Ringkasan Tenaga Farmasi';

    protected function getStats(): array
    {
        return [
            Stat::make('Unit Kerja', TenagaFarmasi::count()),
            Stat::make('Total TTK', TenagaFarmasi::sum('ttk_total')),
            Stat::make('Total Apoteker', TenagaFarmasi::sum('apoteker_total')),
            Stat::make('Total Tenaga Farmasi', TenagaFarmasi::sum('total_total')),
        ];
    }
}
