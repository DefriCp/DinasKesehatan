<?php

namespace App\Filament\Resources\PenderitaKronisFilariasisResource\Pages;

use App\Filament\Resources\PenderitaKronisFilariasisResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PenderitaKronisFilariasisResource\Widgets\KronisFilariasisStatsOverview;
use App\Filament\Resources\PenderitaKronisFilariasisResource\Widgets\KronisFilariasisChart;

class ListPenderitaKronisFilariasis extends ListRecords
{
    protected static string $resource = PenderitaKronisFilariasisResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            KronisFilariasisStatsOverview::class,
            KronisFilariasisChart::class,
        ];
    }
}
