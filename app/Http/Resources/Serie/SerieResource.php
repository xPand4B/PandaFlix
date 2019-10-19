<?php

namespace App\Http\Resources\Serie;

use Illuminate\Http\Resources\Json\JsonResource;

class SerieResource extends JsonResource
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
            'type' => 'serie',
            'id' => (string)$this->id,

            'attributes' => [
                'title' => $this->title,
                'description' => $this->description,
                'cover_image' => $this->cover_image,
                'path' => $this->path
            ],

            'relationships' => [
                // TODO: Add relationships
            ]
        ];
    }
}
