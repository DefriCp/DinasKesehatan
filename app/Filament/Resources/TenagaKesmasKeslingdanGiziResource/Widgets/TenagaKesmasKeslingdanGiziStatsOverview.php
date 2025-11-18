<?php

namespace App\Filament\Resources\TenagaKesmasKeslingdanGiziResource\Widgets;

use App\Models\TenagaKesmasKeslingdanGizi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TenagaKesmasKeslingdanGiziStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Ringkasan Kesmas, Kesling & Gizi';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Unit Kerja', TenagaKesmasKeslingdanGizi::count()),

            Stat::make('Total Kesmas', TenagaKesmasKeslingdanGizi::sum('kesmas_total')),

            Stat::make('Total Kesling', TenagaKesmasKeslingdanGizi::sum('kesling_total')),

            Stat::make('Total Gizi', TenagaKesmasKeslingdanGizi::sum('gizi_total')),
        ];
    }
}
