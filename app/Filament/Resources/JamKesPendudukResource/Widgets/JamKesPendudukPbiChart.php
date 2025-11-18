<?php

namespace App\Filament\Resources\JamKesPendudukResource\Widgets;

use App\Models\JamKesPenduduk;
use Filament\Widgets\ChartWidget;

class JamKesPendudukPbiChart extends ChartWidget
{
    protected static ?string $heading = 'Perbandingan Peserta PBI vs Non PBI';

    protected function getData(): array
    {
        $pbi     = JamKesPenduduk::where('jenis_kepesertaan', 'SUB JUMLAH PBI')->first();
        $nonPbi  = JamKesPenduduk::where('jenis_kepesertaan', 'SUB JUMLAH NON PBI')->first();

        $pbiJumlah    = $pbi?->jumlah    ?? 0;
        $nonPbiJumlah = $nonPbi?->jumlah ?? 0;

        return [
            'datasets' => [
                [
                    'label' => 'Peserta Jaminan Kesehatan',
                    'data'  => [
                        $pbiJumlah,
                        $nonPbiJumlah,
                    ],
                ],
            ],
            'labels' => [
                'PBI',
                'Non PBI',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
