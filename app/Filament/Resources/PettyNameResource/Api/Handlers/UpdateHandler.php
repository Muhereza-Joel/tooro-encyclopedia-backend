<?php
namespace App\Filament\Resources\PettyNameResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PettyNameResource;
use App\Filament\Resources\PettyNameResource\Api\Requests\UpdatePettyNameRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PettyNameResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update PettyName
     *
     * @param UpdatePettyNameRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePettyNameRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}