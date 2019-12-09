<?php

namespace App\Components\User\Resources;

use Illuminate\Http\Request;
use App\Components\Common\PandaFlix;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function toArray($request)
    {
        $this->with = PandaFlix::ResourceAdditions();

        return UserResource::collection($this);
    }
}
