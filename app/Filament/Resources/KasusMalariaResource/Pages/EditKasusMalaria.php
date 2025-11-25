<?php

namespace App\Filament\Resources\KasusMalariaResource\Pages;

use App\Filament\Resources\KasusMalariaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKasusMalaria extends EditRecord
{
    protected static string $resource = KasusMalariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
