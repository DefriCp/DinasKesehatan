<?php

namespace App\Filament\Resources\ImunisasiTdIbuHamilResource\Widgets;

use App\Models\ImunisasiTdIbuHamil;
use Filament\Widgets\ChartWidget;

class ImunisasiTdIbuHamilTd2PlusChart extends ChartWidget
{
    // ChartWidget heading HARUS static
    protected static ?string $heading = 'Grafik Td2+ per Kecamatan';

    protected function getData(): array
    {
        $rows = ImunisasiTdIbuHamil::orderBy('kecamatan')->get();

        return [
            'labels' => $rows->pluck('kecamatan')->toArray(),
            'datasets' => [
                [
                    'label' => 'Td2+ (Jumlah)',
                    'data'  => $rows->pluck('td2_plus')->toArray(),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
