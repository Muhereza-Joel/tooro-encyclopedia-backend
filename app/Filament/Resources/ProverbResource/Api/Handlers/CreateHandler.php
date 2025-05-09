<?php
namespace App\Filament\Resources\ProverbResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ProverbResource;
use App\Filament\Resources\ProverbResource\Api\Requests\CreateProverbRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = ProverbResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Proverb
     *
     * @param CreateProverbRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateProverbRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}