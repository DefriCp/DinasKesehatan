<?php

namespace App\Filament\Resources\PelayananKesehatanIbuResource\Pages;

use App\Filament\Resources\PelayananKesehatanIbuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelayananKesehatanIbu extends EditRecord
{
    protected static string $resource = PelayananKesehatanIbuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
