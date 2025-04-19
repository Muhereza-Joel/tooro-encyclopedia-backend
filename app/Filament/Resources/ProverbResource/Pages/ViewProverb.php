<?php

namespace App\Filament\Resources\ProverbResource\Pages;

use App\Filament\Resources\ProverbResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProverb extends ViewRecord
{
    protected static string $resource = ProverbResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
