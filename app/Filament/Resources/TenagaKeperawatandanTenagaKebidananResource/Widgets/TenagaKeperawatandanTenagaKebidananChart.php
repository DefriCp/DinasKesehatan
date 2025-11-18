<?php

namespace App\Filament\Resources\TenagaKeperawatandanTenagaKebidananResource\Widgets;

use App\Models\TenagaKeperawatandanTenagaKebidanan;
use Filament\Widgets\ChartWidget;

class TenagaKeperawatandanTenagaKebidananChart extends ChartWidget
{
    protected static ?string $heading = 'Perawat & Bidan per Unit Kerja';

    protected function getData(): array
    {
        $rows = TenagaKeperawatandanTenagaKebidanan::query()
            ->orderBy('unit_kerja')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Perawat (L+P)',
                    'data'  => $rows->pluck('perawat_total')->map(fn ($v) => (int) $v),
                ],
                [
                    'label' => 'Bidan',
                    'data'  => $rows->pluck('bidan_total')->map(fn ($v) => (int) $v),
                ],
            ],
            'labels' => $rows->pluck('unit_kerja')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
