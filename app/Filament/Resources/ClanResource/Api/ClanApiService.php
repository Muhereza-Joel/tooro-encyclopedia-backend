<?php
namespace App\Filament\Resources\ClanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ClanResource;
use Illuminate\Routing\Router;


class ClanApiService extends ApiService
{
    protected static string | null $resource = ClanResource::class;

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
