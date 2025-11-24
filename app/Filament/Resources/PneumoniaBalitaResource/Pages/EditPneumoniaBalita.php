<?php

namespace App\Filament\Resources\PneumoniaBalitaResource\Pages;

use App\Filament\Resources\PneumoniaBalitaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPneumoniaBalita extends EditRecord
{
    protected static string $resource = PneumoniaBalitaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
