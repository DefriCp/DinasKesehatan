<?php

namespace App\Filament\Resources\PelayananKesehatanIbuResource\Widgets;

use App\Models\PelayananKesehatanIbu;
use Filament\Widgets\ChartWidget;

class PelayananKesehatanIbuK1K4Chart extends ChartWidget
{
    // ChartWidget: heading HARUS static
    protected static ?string $heading = 'Cakupan K1 & K4 Ibu Hamil per Kecamatan';

    protected function getData(): array
    {
        // Ambil data per kecamatan
        $rows = PelayananKesehatanIbu::query()
            ->orderBy('kecamatan')
            ->get(['kecamatan', 'k1_persen', 'k4_persen']);

        return [
            'datasets' => [
                [
                    'label' => 'K1 (%)',
                    'data'  => $rows->pluck('k1_persen'),
                ],
                [
                    'label' => 'K4 (%)',
                    'data'  => $rows->pluck('k4_persen'),
                ],
            ],
            'labels' => $rows->pluck('kecamatan')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
