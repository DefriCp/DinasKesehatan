<?php

namespace App\Filament\Resources\KasusFluBurungResource\Pages;

use App\Filament\Resources\KasusFluBurungResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKasusFluBurung extends EditRecord
{
    protected static string $resource = KasusFluBurungResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
