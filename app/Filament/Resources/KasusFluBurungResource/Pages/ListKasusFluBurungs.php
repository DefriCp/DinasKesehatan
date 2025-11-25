<?php

namespace App\Filament\Resources\KasusFluBurungResource\Pages;

use App\Filament\Resources\KasusFluBurungResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\KasusFluBurungResource\Widgets\FluBurungStatsOverview;
use App\Filament\Resources\KasusFluBurungResource\Widgets\KasusFluBurungChart;
use App\Filament\Resources\KasusFluBurungResource\Widgets\KematianFluBurungChart;

class ListKasusFluBurungs extends ListRecords
{
    protected static string $resource = KasusFluBurungResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            FluBurungStatsOverview::class,
            KasusFluBurungChart::class,
            KematianFluBurungChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
