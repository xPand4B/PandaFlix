<?php

namespace App\Http\Resources\Episode;

use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeResource extends JsonResource
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
            'type' => 'episode',
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
