<?php

namespace App\Http\Resources\Collection;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
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
            'type' => 'collection',
            'id' => (string)$this->id,

            'attributes' => [
                'name' => $this->name
            ],

            'relationships' => [
                // TODO: Add relationships
            ]
        ];
    }
}
