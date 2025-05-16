<?php
namespace App\Filament\Resources\PettyNameResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\PettyName;

/**
 * @property PettyName $resource
 */
class PettyNameTransformer extends JsonResource
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
