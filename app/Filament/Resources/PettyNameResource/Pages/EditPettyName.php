<?php

namespace App\Filament\Resources\PettyNameResource\Pages;

use App\Filament\Resources\PettyNameResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPettyName extends EditRecord
{
    protected static string $resource = PettyNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
