<?php

namespace App\Filament\Resources\AngkaKematianRSResource\Pages;

use App\Filament\Resources\AngkaKematianRSResource;
use App\Filament\Resources\AngkaKematianRSResource\Widgets\AngkaKematianRSStatsOverview;
use App\Filament\Resources\AngkaKematianRSResource\Widgets\AngkaKematianRSChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAngkaKematianRS extends ListRecords
{
    protected static string $resource = AngkaKematianRSResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AngkaKematianRSStatsOverview::class,
            AngkaKematianRSChart::class,
        ];
    }
}
