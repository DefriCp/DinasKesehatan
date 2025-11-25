<?php

namespace App\Filament\Resources\PelayananKesehatanDMResource\Widgets;

use App\Models\PelayananKesehatanDM;
use Filament\Widgets\ChartWidget;

class DMCoverageChart extends ChartWidget
{
    protected static ?string $heading = 'Cakupan Pelayanan DM per Puskesmas';
    protected static bool $isDiscovered = false;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $rows = PelayananKesehatanDM::query()
            ->orderBy('kecamatan')
            ->orderBy('puskesmas')
            ->get();

        return [
            'labels' => $rows->map(fn ($row) => $row->kecamatan . ' - ' . $row->puskesmas)->toArray(),
            'datasets' => [
                [
                    'label' => 'Penderita DM',
                    'data'  => $rows->pluck('jumlah_penderita_dm')->toArray(),
                    'backgroundColor' => '#9ca3af', // abu-abu
                ],
                [
                    'label' => 'Mendapat Pelayanan',
                    'data'  => $rows->pluck('pelayanan_jumlah')->toArray(),
                    'backgroundColor' => '#22c55e', // hijau
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
