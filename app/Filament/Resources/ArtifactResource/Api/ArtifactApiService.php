<?php
namespace App\Filament\Resources\ArtifactResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\ArtifactResource;
use Illuminate\Routing\Router;


class ArtifactApiService extends ApiService
{
    protected static string | null $resource = ArtifactResource::class;

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
