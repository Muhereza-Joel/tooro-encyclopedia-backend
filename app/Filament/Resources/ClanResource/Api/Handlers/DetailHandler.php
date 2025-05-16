<?php

namespace App\Filament\Resources\ClanResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\ClanResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\ClanResource\Api\Transformers\ClanTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = ClanResource::class;


    /**
     * Show Clan
     *
     * @param Request $request
     * @return ClanTransformer
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

        return new ClanTransformer($query);
    }
}
