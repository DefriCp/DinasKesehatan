<?php

namespace App\Filament\Resources\KejadianLuarBiasaResource\Pages;

use App\Filament\Resources\KejadianLuarBiasaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\KejadianLuarBiasaResource\Widgets\KlbStatsOverview;
use App\Filament\Resources\KejadianLuarBiasaResource\Widgets\KlbPerJenisChart;

class ListKejadianLuarBiasas extends ListRecords
{
    protected static string $resource = KejadianLuarBiasaResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            KlbStatsOverview::class,
            KlbPerJenisChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
