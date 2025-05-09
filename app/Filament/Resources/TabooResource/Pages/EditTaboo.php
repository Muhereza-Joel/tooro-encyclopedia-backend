<?php

namespace App\Filament\Resources\TabooResource\Pages;

use App\Filament\Resources\TabooResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaboo extends EditRecord
{
    protected static string $resource = TabooResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
