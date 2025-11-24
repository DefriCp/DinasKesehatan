<?php

namespace App\Filament\Resources\PelayananKesehatanUsiaProduktifResource\Widgets;

use App\Models\PelayananKesehatanUsiaProduktif;
use Filament\Widgets\ChartWidget;

class PelayananKesehatanUsiaProduktifChart extends ChartWidget
{
    protected static ?string $heading = 'Cakupan Skrining Usia Produktif per Kecamatan';

    protected function getData(): array
    {
        $rows = PelayananKesehatanUsiaProduktif::query()
            ->orderBy('kecamatan')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Skrining % (L+P)',
                    'data'  => $rows->pluck('skrining_total_persen'),
                ],
                [
                    'label' => 'Berisiko % (L+P)',
                    'data'  => $rows->pluck('berisiko_total_persen'),
                ],
            ],
            'labels' => $rows->pluck('kecamatan'),
        ];
    }

    protected function getType(): string
    {
        // Bisa 'bar', 'line', dll. Di sini bar chart.
        return 'bar';
    }
}
