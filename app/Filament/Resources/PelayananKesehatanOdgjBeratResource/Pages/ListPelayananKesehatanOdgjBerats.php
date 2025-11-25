<?php

namespace App\Filament\Resources\PelayananKesehatanOdgjBeratResource\Pages;

use App\Filament\Resources\PelayananKesehatanOdgjBeratResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PelayananKesehatanOdgjBeratResource\Widgets\OdgjBeratStatsOverview;
use App\Filament\Resources\PelayananKesehatanOdgjBeratResource\Widgets\OdgjBeratCoverageChart;

class ListPelayananKesehatanOdgjBerats extends ListRecords
{
    protected static string $resource = PelayananKesehatanOdgjBeratResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            OdgjBeratStatsOverview::class,
            OdgjBeratCoverageChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
