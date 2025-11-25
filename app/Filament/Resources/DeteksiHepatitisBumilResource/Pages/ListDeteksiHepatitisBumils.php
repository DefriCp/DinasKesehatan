<?php

namespace App\Filament\Resources\DeteksiHepatitisBumilResource\Pages;

use App\Filament\Resources\DeteksiHepatitisBumilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\DeteksiHepatitisBumilResource\Widgets\DeteksiHepatitisBumilStatsOverview;
use App\Filament\Resources\DeteksiHepatitisBumilResource\Widgets\DeteksiHepatitisBumilChart;

class ListDeteksiHepatitisBumils extends ListRecords
{
    protected static string $resource = DeteksiHepatitisBumilResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            DeteksiHepatitisBumilStatsOverview::class,
            DeteksiHepatitisBumilChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
