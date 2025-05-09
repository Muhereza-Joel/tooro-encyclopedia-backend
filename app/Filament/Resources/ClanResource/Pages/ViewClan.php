<?php

namespace App\Filament\Resources\ClanResource\Pages;

use App\Filament\Resources\ClanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewClan extends ViewRecord
{
    protected static string $resource = ClanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
