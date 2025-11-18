<?php

namespace App\Filament\Resources\AngkaKematianRSResource\Pages;

use App\Filament\Resources\AngkaKematianRSResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAngkaKematianRS extends EditRecord
{
    protected static string $resource = AngkaKematianRSResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
