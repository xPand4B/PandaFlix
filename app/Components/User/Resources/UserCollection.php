<?php

namespace App\Components\User\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return UserResource
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        return new UserResource($this);
    }
}
