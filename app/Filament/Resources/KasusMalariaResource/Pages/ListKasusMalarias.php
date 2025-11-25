<?php

namespace App\Filament\Resources\KasusMalariaResource\Pages;

use App\Filament\Resources\KasusMalariaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\KasusMalariaResource\Widgets\KasusMalariaStatsOverview;
use App\Filament\Resources\KasusMalariaResource\Widgets\KasusMalariaChart;

class ListKasusMalarias extends ListRecords
{
    protected static string $resource = KasusMalariaResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            KasusMalariaStatsOverview::class,
            KasusMalariaChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
