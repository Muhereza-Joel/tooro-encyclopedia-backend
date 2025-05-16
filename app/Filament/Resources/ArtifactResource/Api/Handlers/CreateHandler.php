<?php
namespace App\Filament\Resources\ArtifactResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\ArtifactResource;
use App\Filament\Resources\ArtifactResource\Api\Requests\CreateArtifactRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = ArtifactResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Artifact
     *
     * @param CreateArtifactRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateArtifactRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}