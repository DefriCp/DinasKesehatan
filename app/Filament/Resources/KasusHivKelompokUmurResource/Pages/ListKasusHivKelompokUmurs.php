<?php

namespace App\Filament\Resources\KasusHivKelompokUmurResource\Pages;

use App\Filament\Resources\KasusHivKelompokUmurResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\KasusHivKelompokUmurResource\Widgets\HivUmurStatsOverview;
use App\Filament\Resources\KasusHivKelompokUmurResource\Widgets\HivUmurChart;

class ListKasusHivKelompokUmurs extends ListRecords
{
    protected static string $resource = KasusHivKelompokUmurResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            HivUmurStatsOverview::class,
            HivUmurChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
