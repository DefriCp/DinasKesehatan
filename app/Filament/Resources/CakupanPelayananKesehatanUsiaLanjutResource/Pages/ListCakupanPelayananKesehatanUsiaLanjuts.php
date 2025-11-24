<?php

namespace App\Filament\Resources\CakupanPelayananKesehatanUsiaLanjutResource\Pages;

use App\Filament\Resources\CakupanPelayananKesehatanUsiaLanjutResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CakupanPelayananKesehatanUsiaLanjutResource\Widgets\CakupanLansiaStatsOverview;
use App\Filament\Resources\CakupanPelayananKesehatanUsiaLanjutResource\Widgets\CakupanLansiaChart;

class ListCakupanPelayananKesehatanUsiaLanjuts extends ListRecords
{
    protected static string $resource = CakupanPelayananKesehatanUsiaLanjutResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            CakupanLansiaStatsOverview::class,
            CakupanLansiaChart::class,
        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
