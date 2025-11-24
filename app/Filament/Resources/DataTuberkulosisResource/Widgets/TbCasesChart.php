<?php

namespace App\Filament\Resources\DataTuberkulosisResource\Widgets;

use App\Models\DataTuberkulosis;
use Filament\Widgets\ChartWidget;

class TbCasesChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Kasus Tuberkulosis per Puskesmas';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = DataTuberkulosis::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get();

        return [
            'labels' => $rows->map(function ($row) {
                return trim(($row->kecamatan ? $row->kecamatan . ' - ' : '') . $row->puskesmas);
            })->toArray(),

            'datasets' => [
                [
                    'label' => 'Total kasus TB (L+P)',
                    'data'  => $rows->pluck('kasus_tb_total_jumlah')->toArray(),
                    'backgroundColor' => '#4f46e5',
                ],
                [
                    'label' => 'Kasus TB anak 0–14 th',
                    'data'  => $rows->pluck('kasus_tb_anak_0_14_jumlah')->toArray(),
                    'backgroundColor' => '#f97316',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
