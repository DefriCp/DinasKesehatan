<?php

namespace App\Filament\Resources\DataTuberkulosisResource\Pages;

use App\Filament\Resources\DataTuberkulosisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DataTuberkulosisResource\Widgets\TbStatsOverview;
use App\Filament\Resources\DataTuberkulosisResource\Widgets\TbCasesChart;

class ListDataTuberkulosis extends ListRecords
{
    protected static string $resource = DataTuberkulosisResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            TbStatsOverview::class,
            TbCasesChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
