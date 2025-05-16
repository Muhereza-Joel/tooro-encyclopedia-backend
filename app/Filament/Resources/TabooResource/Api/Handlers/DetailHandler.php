<?php

namespace App\Filament\Resources\TabooResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\TabooResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\TabooResource\Api\Transformers\TabooTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = TabooResource::class;


    /**
     * Show Taboo
     *
     * @param Request $request
     * @return TabooTransformer
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

        return new TabooTransformer($query);
    }
}
