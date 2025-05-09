<?php

namespace App\Filament\Resources\PettyNameResource\Pages;

use App\Filament\Resources\PettyNameResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPettyName extends ViewRecord
{
    protected static string $resource = PettyNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
