<?php

namespace App\Filament\Resources\PelayananKesehatanUsiaProduktifResource\Pages;

use App\Filament\Resources\PelayananKesehatanUsiaProduktifResource;
use App\Filament\Resources\PelayananKesehatanUsiaProduktifResource\Widgets\PelayananKesehatanUsiaProduktifStatsOverview;
use App\Filament\Resources\PelayananKesehatanUsiaProduktifResource\Widgets\PelayananKesehatanUsiaProduktifChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPelayananKesehatanUsiaProduktifs extends ListRecords
{
    protected static string $resource = PelayananKesehatanUsiaProduktifResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    /**
     * Widget yang tampil di atas tabel pada halaman index
     */
    protected function getHeaderWidgets(): array
    {
        return [
            PelayananKesehatanUsiaProduktifStatsOverview::class,
            PelayananKesehatanUsiaProduktifChart::class,
        ];
    }
}
