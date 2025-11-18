<?php

namespace App\Filament\Resources\TenagaFarmasiResource\Pages;

use App\Filament\Resources\TenagaFarmasiResource;
use App\Filament\Resources\TenagaFarmasiResource\Widgets\TenagaFarmasiStatsOverview;
use App\Filament\Resources\TenagaFarmasiResource\Widgets\TenagaFarmasiChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTenagaFarmasis extends ListRecords
{
    protected static string $resource = TenagaFarmasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TenagaFarmasiStatsOverview::class,
            TenagaFarmasiChart::class,
        ];
    }
}
