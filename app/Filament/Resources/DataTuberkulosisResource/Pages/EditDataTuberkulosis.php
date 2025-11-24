<?php

namespace App\Filament\Resources\DataTuberkulosisResource\Pages;

use App\Filament\Resources\DataTuberkulosisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataTuberkulosis extends EditRecord
{
    protected static string $resource = DataTuberkulosisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
