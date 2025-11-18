<?php

namespace App\Filament\Resources\JamKesPendudukResource\Pages;

use App\Filament\Resources\JamKesPendudukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJamKesPenduduk extends EditRecord
{
    protected static string $resource = JamKesPendudukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
