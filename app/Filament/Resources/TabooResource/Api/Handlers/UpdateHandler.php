<?php
namespace App\Filament\Resources\TabooResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\TabooResource;
use App\Filament\Resources\TabooResource\Api\Requests\UpdateTabooRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = TabooResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Taboo
     *
     * @param UpdateTabooRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateTabooRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}