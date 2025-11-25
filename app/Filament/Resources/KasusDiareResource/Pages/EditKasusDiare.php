<?php

namespace App\Filament\Resources\KasusDiareResource\Pages;

use App\Filament\Resources\KasusDiareResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKasusDiare extends EditRecord
{
    protected static string $resource = KasusDiareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
