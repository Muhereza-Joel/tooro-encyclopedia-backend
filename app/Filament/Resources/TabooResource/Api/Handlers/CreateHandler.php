<?php
namespace App\Filament\Resources\TabooResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\TabooResource;
use App\Filament\Resources\TabooResource\Api\Requests\CreateTabooRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = TabooResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Taboo
     *
     * @param CreateTabooRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateTabooRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}