<?php
namespace App\Filament\Resources\PettyNameResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PettyNameResource;
use Illuminate\Routing\Router;


class PettyNameApiService extends ApiService
{
    protected static string | null $resource = PettyNameResource::class;

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
