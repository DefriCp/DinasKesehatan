<?php

namespace App\Filament\Resources\PelayananKesehatanOdgjBeratResource\Widgets;

use App\Models\PelayananKesehatanOdgjBerat;
use Filament\Widgets\ChartWidget;

class OdgjBeratCoverageChart extends ChartWidget
{
    protected static ?string $heading = 'Cakupan Pelayanan ODGJ Berat per Puskesmas';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = PelayananKesehatanOdgjBerat::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get();

        return [
            'labels' => $rows->map(fn ($row) => $row->kecamatan . ' - ' . $row->puskesmas)->toArray(),
            'datasets' => [
                [
                    'label' => 'Sasaran ODGJ Berat',
                    'data'  => $rows->pluck('sasaran_odgj_berat')->toArray(),
                    'backgroundColor' => '#9ca3af',
                ],
                [
                    'label' => 'Mendapat Pelayanan',
                    'data'  => $rows->pluck('pelayanan_jumlah')->toArray(),
                    'backgroundColor' => '#22c55e',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
