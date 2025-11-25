<?php

namespace App\Filament\Resources\KasusDbdResource\Pages;

use App\Filament\Resources\KasusDbdResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\KasusDbdResource\Widgets\KasusDbdStatsOverview;
use App\Filament\Resources\KasusDbdResource\Widgets\KasusDbdChart;

class ListKasusDbds extends ListRecords
{
    protected static string $resource = KasusDbdResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            KasusDbdStatsOverview::class,
            KasusDbdChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
