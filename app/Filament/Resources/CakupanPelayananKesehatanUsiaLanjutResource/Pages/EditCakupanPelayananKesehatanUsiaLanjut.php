<?php

namespace App\Filament\Resources\CakupanPelayananKesehatanUsiaLanjutResource\Pages;

use App\Filament\Resources\CakupanPelayananKesehatanUsiaLanjutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCakupanPelayananKesehatanUsiaLanjut extends EditRecord
{
    protected static string $resource = CakupanPelayananKesehatanUsiaLanjutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
