<?php
namespace App\Filament\Resources\ArtifactResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Artifact;

/**
 * @property Artifact $resource
 */
class ArtifactTransformer extends JsonResource
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
