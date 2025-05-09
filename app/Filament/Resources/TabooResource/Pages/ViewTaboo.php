<?php

namespace App\Filament\Resources\TabooResource\Pages;

use App\Filament\Resources\TabooResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTaboo extends ViewRecord
{
    protected static string $resource = TabooResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
