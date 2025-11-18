<?php

namespace App\Filament\Resources\TenagaTeknikBiomedikaKeterapianKeteknisianResource\Pages;

use App\Filament\Resources\TenagaTeknikBiomedikaKeterapianKeteknisianResource;
use App\Filament\Resources\TenagaTeknikBiomedikaKeterapianKeteknisianResource\Widgets\TenagaTeknikBiomedikaKeterapianKeteknisianStatsOverview;
use App\Filament\Resources\TenagaTeknikBiomedikaKeterapianKeteknisianResource\Widgets\TenagaTeknikBiomedikaKeterapianKeteknisianChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTenagaTeknikBiomedikaKeterapianKeteknisian extends ListRecords
{
    protected static string $resource = TenagaTeknikBiomedikaKeterapianKeteknisianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TenagaTeknikBiomedikaKeterapianKeteknisianStatsOverview::class,
            TenagaTeknikBiomedikaKeterapianKeteknisianChart::class,
        ];
    }
}
