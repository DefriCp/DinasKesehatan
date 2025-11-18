<?php

namespace App\Filament\Resources\TenagaKesmasKeslingdanGiziResource\Pages;

use App\Filament\Resources\TenagaKesmasKeslingdanGiziResource;
use App\Filament\Resources\TenagaKesmasKeslingdanGiziResource\Widgets\TenagaKesmasKeslingdanGiziStatsOverview;
use App\Filament\Resources\TenagaKesmasKeslingdanGiziResource\Widgets\TenagaKesmasKeslingdanGiziChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTenagaKesmasKeslingdanGizi extends ListRecords
{
    protected static string $resource = TenagaKesmasKeslingdanGiziResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TenagaKesmasKeslingdanGiziStatsOverview::class,
            TenagaKesmasKeslingdanGiziChart::class,
        ];
    }
}
