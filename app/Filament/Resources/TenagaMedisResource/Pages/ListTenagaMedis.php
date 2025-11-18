<?php

namespace App\Filament\Resources\TenagaMedisResource\Pages;

use App\Filament\Resources\TenagaMedisResource;
use App\Filament\Resources\TenagaMedisResource\Widgets\TenagaMedisStatsOverview;
use App\Filament\Resources\TenagaMedisResource\Widgets\TenagaMedisChart;
use Filament\Resources\Pages\ListRecords;

class ListTenagaMedis extends ListRecords
{
    protected static string $resource = TenagaMedisResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            TenagaMedisStatsOverview::class,
            TenagaMedisChart::class,
        ];
    }
}
