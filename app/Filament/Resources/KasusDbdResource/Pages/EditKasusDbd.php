<?php

namespace App\Filament\Resources\KasusDbdResource\Pages;

use App\Filament\Resources\KasusDbdResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKasusDbd extends EditRecord
{
    protected static string $resource = KasusDbdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
