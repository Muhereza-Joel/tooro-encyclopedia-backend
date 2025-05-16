<?php
namespace App\Filament\Resources\ClanResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Clan;

/**
 * @property Clan $resource
 */
class ClanTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
