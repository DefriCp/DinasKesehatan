<?php

namespace App\Filament\Resources\TenagaMedisResource\Widgets;

use App\Models\TenagaMedis;
use Filament\Widgets\ChartWidget;

class TenagaMedisChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Tenaga Medis per Unit Kerja';

    protected function getData(): array
    {
        $data = TenagaMedis::query()
            ->orderBy('unit_kerja')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Dokter',
                    'data'  => $data->pluck('dokter_total')->map(fn ($v) => (int) $v),
                ],
                [
                    'label' => 'Total Dokter Gigi',
                    'data'  => $data->pluck('jumlah_gigi_total')->map(fn ($v) => (int) $v),
                ],
            ],
            'labels' => $data->pluck('unit_kerja')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // bar chart
    }
}
