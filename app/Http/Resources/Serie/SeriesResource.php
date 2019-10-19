<?php

namespace App\Http\Resources\Serie;

use Illuminate\Http\Resources\Json\JsonResource;

class SeriesResource extends JsonResource
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
                'self' => route('serie.show', ['serie' => $this])
            ],

            'data' => new SerieResource($this)
        ];
    }
}
