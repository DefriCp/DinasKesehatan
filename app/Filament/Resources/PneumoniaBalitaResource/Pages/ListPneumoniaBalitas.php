<?php

namespace App\Filament\Resources\PneumoniaBalitaResource\Pages;

use App\Filament\Resources\PneumoniaBalitaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PneumoniaBalitaResource\Widgets\PneumoniaBalitaStatsOverview;
use App\Filament\Resources\PneumoniaBalitaResource\Widgets\PneumoniaBalitaChart;

class ListPneumoniaBalitas extends ListRecords
{
    protected static string $resource = PneumoniaBalitaResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            PneumoniaBalitaStatsOverview::class,
            PneumoniaBalitaChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
