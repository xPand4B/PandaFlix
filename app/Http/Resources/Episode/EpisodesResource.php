<?php

namespace App\Http\Resources\Episode;

use Illuminate\Http\Resources\Json\JsonResource;

class EpisodesResource extends JsonResource
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
                'self' => route('episode.show', ['episode' => $this])
            ],

            'data' => new EpisodeResource($this)
        ];
    }
}
