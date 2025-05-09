<?php

namespace App\Filament\Resources\PettyNameResource\Pages;

use App\Filament\Resources\PettyNameResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPettyNames extends ListRecords
{
    protected static string $resource = PettyNameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
