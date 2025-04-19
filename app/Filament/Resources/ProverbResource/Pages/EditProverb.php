<?php

namespace App\Filament\Resources\ProverbResource\Pages;

use App\Filament\Resources\ProverbResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProverb extends EditRecord
{
    protected static string $resource = ProverbResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
