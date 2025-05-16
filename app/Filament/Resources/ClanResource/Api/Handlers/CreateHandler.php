<?php

namespace App\Filament\Resources\ClanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ClanResource;
use App\Filament\Resources\ClanResource\Api\Requests\CreateClanRequest;

class CreateHandler extends Handlers
{
    public static string | null $uri = '/';
    public static string | null $resource = ClanResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Create Clan
     *
     * @param CreateClanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateClanRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}
