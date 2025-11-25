<?php

namespace App\Filament\Resources\PelayananKesehatanDMResource\Pages;

use App\Filament\Resources\PelayananKesehatanDMResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PelayananKesehatanDMResource\Widgets\DMStatsOverview;
use App\Filament\Resources\PelayananKesehatanDMResource\Widgets\DMCoverageChart;

class ListPelayananKesehatanDMS extends ListRecords
{
    protected static string $resource = PelayananKesehatanDMResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            DMStatsOverview::class,
            DMCoverageChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
