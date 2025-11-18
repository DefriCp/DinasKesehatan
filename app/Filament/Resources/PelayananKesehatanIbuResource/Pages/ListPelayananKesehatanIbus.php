<?php

namespace App\Filament\Resources\PelayananKesehatanIbuResource\Pages;

use App\Filament\Resources\PelayananKesehatanIbuResource;
use App\Filament\Resources\PelayananKesehatanIbuResource\Widgets\PelayananKesehatanIbuStatsOverview;
use App\Filament\Resources\PelayananKesehatanIbuResource\Widgets\PelayananKesehatanIbuK1K4Chart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPelayananKesehatanIbus extends ListRecords
{
    protected static string $resource = PelayananKesehatanIbuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PelayananKesehatanIbuStatsOverview::class,
            PelayananKesehatanIbuK1K4Chart::class,
        ];
    }
}
