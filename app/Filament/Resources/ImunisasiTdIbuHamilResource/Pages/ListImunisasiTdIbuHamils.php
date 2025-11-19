<?php

namespace App\Filament\Resources\ImunisasiTdIbuHamilResource\Pages;

use App\Filament\Resources\ImunisasiTdIbuHamilResource;
use App\Filament\Resources\ImunisasiTdIbuHamilResource\Widgets\ImunisasiTdIbuHamilStatsOverview;
use App\Filament\Resources\ImunisasiTdIbuHamilResource\Widgets\ImunisasiTdIbuHamilTd2PlusChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImunisasiTdIbuHamils extends ListRecords
{
    protected static string $resource = ImunisasiTdIbuHamilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ImunisasiTdIbuHamilStatsOverview::class,
            ImunisasiTdIbuHamilTd2PlusChart::class,
        ];
    }
}
