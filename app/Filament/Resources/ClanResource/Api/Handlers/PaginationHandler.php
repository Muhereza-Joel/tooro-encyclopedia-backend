<?php

namespace App\Filament\Resources\ClanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\ClanResource;
use App\Filament\Resources\ClanResource\Api\Transformers\ClanTransformer;

class PaginationHandler extends Handlers
{
    public static string | null $uri = '/';
    public static string | null $resource = ClanResource::class;


    /**
     * List of Clan
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? [])
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return ClanTransformer::collection($query);
    }
}
