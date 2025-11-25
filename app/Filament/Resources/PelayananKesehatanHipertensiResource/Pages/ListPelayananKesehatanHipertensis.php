<?php

namespace App\Filament\Resources\PelayananKesehatanHipertensiResource\Pages;

use App\Filament\Resources\PelayananKesehatanHipertensiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PelayananKesehatanHipertensiResource\Widgets\HipertensiStatsOverview;
use App\Filament\Resources\PelayananKesehatanHipertensiResource\Widgets\HipertensiCoverageChart;

class ListPelayananKesehatanHipertensis extends ListRecords
{
    protected static string $resource = PelayananKesehatanHipertensiResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            HipertensiStatsOverview::class,
            HipertensiCoverageChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
