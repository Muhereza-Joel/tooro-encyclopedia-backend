<?php
namespace App\Filament\Resources\ProverbResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ProverbResource;
use Illuminate\Routing\Router;


class ProverbApiService extends ApiService
{
    protected static string | null $resource = ProverbResource::class;

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
