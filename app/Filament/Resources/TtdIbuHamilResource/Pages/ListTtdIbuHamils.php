<?php

namespace App\Filament\Resources\TtdIbuHamilResource\Pages;

use App\Filament\Resources\TtdIbuHamilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTtdIbuHamils extends ListRecords
{
    protected static string $resource = TtdIbuHamilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\TtdIbuHamilResource\Widgets\TtdIbuHamilStatsOverview::class,
            \App\Filament\Resources\TtdIbuHamilResource\Widgets\TtdIbuHamilChart::class,
    ];
    }

}
