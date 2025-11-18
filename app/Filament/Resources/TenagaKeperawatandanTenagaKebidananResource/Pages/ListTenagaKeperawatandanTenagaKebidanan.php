<?php

namespace App\Filament\Resources\TenagaKeperawatandanTenagaKebidananResource\Pages;

use App\Filament\Resources\TenagaKeperawatandanTenagaKebidananResource;
use App\Filament\Resources\TenagaKeperawatandanTenagaKebidananResource\Widgets\TenagaKeperawatandanTenagaKebidananStatsOverview;
use App\Filament\Resources\TenagaKeperawatandanTenagaKebidananResource\Widgets\TenagaKeperawatandanTenagaKebidananChart;
use Filament\Resources\Pages\ListRecords;

class ListTenagaKeperawatandanTenagaKebidanan extends ListRecords
{
    protected static string $resource = TenagaKeperawatandanTenagaKebidananResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            TenagaKeperawatandanTenagaKebidananStatsOverview::class,
            TenagaKeperawatandanTenagaKebidananChart::class,
        ];
    }
}
