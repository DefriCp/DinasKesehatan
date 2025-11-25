<?php

namespace App\Filament\Resources\KasusBaruKustaResource\Pages;

use App\Filament\Resources\KasusBaruKustaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\KasusBaruKustaResource\Widgets\KasusBaruKustaStatsOverview;
use App\Filament\Resources\KasusBaruKustaResource\Widgets\KasusBaruKustaChart;

class ListKasusBaruKustas extends ListRecords
{
    protected static string $resource = KasusBaruKustaResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            KasusBaruKustaStatsOverview::class,
            KasusBaruKustaChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
