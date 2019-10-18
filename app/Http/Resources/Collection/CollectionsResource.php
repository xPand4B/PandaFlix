<?php

namespace App\Http\Resources\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'links' => [
                'self' => route('collection.show', ['collection' => $this])
            ],

            'data' => new CollectionResource($this)
        ];
    }
}
