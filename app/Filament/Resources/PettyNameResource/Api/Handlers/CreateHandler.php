<?php
namespace App\Filament\Resources\PettyNameResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\PettyNameResource;
use App\Filament\Resources\PettyNameResource\Api\Requests\CreatePettyNameRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PettyNameResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create PettyName
     *
     * @param CreatePettyNameRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePettyNameRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}