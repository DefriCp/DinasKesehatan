<?php

namespace App\Filament\Resources\PenderitaKronisFilariasisResource\Pages;

use App\Filament\Resources\PenderitaKronisFilariasisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenderitaKronisFilariasis extends EditRecord
{
    protected static string $resource = PenderitaKronisFilariasisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
