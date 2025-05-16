<?php

namespace App\Filament\Resources\ClanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ClanResource;
use App\Filament\Resources\ClanResource\Api\Requests\UpdateClanRequest;

class UpdateHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = ClanResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }


    /**
     * Update Clan
     *
     * @param UpdateClanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateClanRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Clan Resource Updated Successfully");
    }
}
