<?php
namespace App\Filament\Resources\TabooResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\TabooResource;
use Illuminate\Routing\Router;


class TabooApiService extends ApiService
{
    protected static string | null $resource = TabooResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
