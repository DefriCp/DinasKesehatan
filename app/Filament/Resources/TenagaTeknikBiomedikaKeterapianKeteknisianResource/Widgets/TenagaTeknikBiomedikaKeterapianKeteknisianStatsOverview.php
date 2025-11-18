<?php

namespace App\Filament\Resources\TenagaTeknikBiomedikaKeterapianKeteknisianResource\Widgets;

use App\Models\TenagaTeknikBiomedikaKeterapianKeteknisian;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TenagaTeknikBiomedikaKeterapianKeteknisianStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Ringkasan Biomedika, Keterapian & Keteknisian';

    protected function getStats(): array
    {
        return [
            Stat::make('Unit Kerja', TenagaTeknikBiomedikaKeterapianKeteknisian::count()),
            Stat::make('Total ATL', TenagaTeknikBiomedikaKeterapianKeteknisian::sum('atl_total')),
            Stat::make('Total Biomedika', TenagaTeknikBiomedikaKeterapianKeteknisian::sum('biomedika_total')),
            Stat::make('Keterapian Fisik', TenagaTeknikBiomedikaKeterapianKeteknisian::sum('keterapian_total')),
            Stat::make('Keteknisian Medis', TenagaTeknikBiomedikaKeterapianKeteknisian::sum('keteknisian_total')),
        ];
    }
}
