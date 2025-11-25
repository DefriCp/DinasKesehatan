<?php

namespace App\Filament\Resources\KasusDiareResource\Pages;

use App\Filament\Resources\KasusDiareResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\KasusDiareResource\Widgets\KasusDiareStatsOverview;
use App\Filament\Resources\KasusDiareResource\Widgets\KasusDiareChart;

class ListKasusDiares extends ListRecords
{
    protected static string $resource = KasusDiareResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            KasusDiareStatsOverview::class,
            KasusDiareChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
