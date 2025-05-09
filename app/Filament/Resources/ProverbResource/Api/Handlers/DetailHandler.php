<?php

namespace App\Filament\Resources\ProverbResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\ProverbResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\ProverbResource\Api\Transformers\ProverbTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = ProverbResource::class;


    /**
     * Show Proverb
     *
     * @param Request $request
     * @return ProverbTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new ProverbTransformer($query);
    }
}
