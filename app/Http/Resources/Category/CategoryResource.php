<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'type' => 'category',
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
