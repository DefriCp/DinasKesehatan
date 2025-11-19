<?php

namespace App\Filament\Resources\TtdIbuHamilResource\Pages;

use App\Filament\Resources\TtdIbuHamilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTtdIbuHamil extends EditRecord
{
    protected static string $resource = TtdIbuHamilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
