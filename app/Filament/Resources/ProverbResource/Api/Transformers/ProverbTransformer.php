<?php
namespace App\Filament\Resources\ProverbResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Proverb;

/**
 * @property Proverb $resource
 */
class ProverbTransformer extends JsonResource
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
