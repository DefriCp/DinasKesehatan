<?php

namespace App\Filament\Resources\JamKesPendudukResource\Pages;

use App\Filament\Resources\JamKesPendudukResource;
use App\Filament\Resources\JamKesPendudukResource\Widgets\JamKesPendudukStatsOverview;
use App\Filament\Resources\JamKesPendudukResource\Widgets\JamKesPendudukPbiChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJamKesPenduduks extends ListRecords
{
    protected static string $resource = JamKesPendudukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            JamKesPendudukStatsOverview::class,
            JamKesPendudukPbiChart::class,
        ];
    }
}
