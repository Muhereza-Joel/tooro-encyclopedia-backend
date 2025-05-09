<?php
namespace App\Filament\Resources\ProverbResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ProverbResource;
use App\Filament\Resources\ProverbResource\Api\Requests\UpdateProverbRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = ProverbResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Proverb
     *
     * @param UpdateProverbRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateProverbRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}