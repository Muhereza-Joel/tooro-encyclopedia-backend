<?php
namespace App\Filament\Resources\TabooResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Taboo;

/**
 * @property Taboo $resource
 */
class TabooTransformer extends JsonResource
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
