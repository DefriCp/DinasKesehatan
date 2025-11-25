<?php

namespace App\Filament\Resources\DeteksiHepatitisBumilResource\Pages;

use App\Filament\Resources\DeteksiHepatitisBumilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDeteksiHepatitisBumil extends EditRecord
{
    protected static string $resource = DeteksiHepatitisBumilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
