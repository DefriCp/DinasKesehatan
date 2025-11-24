<?php

namespace App\Filament\Resources\CakupanPelayananKesehatanUsiaLanjutResource\Widgets;

use App\Models\CakupanPelayananKesehatanUsiaLanjut;
use Filament\Widgets\ChartWidget;

class CakupanLansiaChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Cakupan Skrining Lansia 60+ per Kecamatan';
    protected static bool $isDiscovered = false; // dipanggil manual di List Page
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = CakupanPelayananKesehatanUsiaLanjut::query()
            ->orderBy('kecamatan')
            ->get();

        return [
            'labels' => $rows->pluck('kecamatan')->toArray(),

            'datasets' => [
                [
                    'label' => 'Lansia 60+ (L+P)',
                    'data' => $rows->pluck('lansia_total')->toArray(),
                    'backgroundColor' => '#4f46e5',
                ],
                [
                    'label' => 'Telah Skrining',
                    'data' => $rows->pluck('skrining_total_jumlah')->toArray(),
                    'backgroundColor' => '#10b981',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
