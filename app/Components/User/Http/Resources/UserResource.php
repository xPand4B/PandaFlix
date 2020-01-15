<?php

namespace App\Components\User\Http\Resources;

use App\Components\Common\PandaFlix;
use App\Components\User\Database\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        $this->with = PandaFlix::ResourceAdditions();

        return [
            'type' => User::class,
            'id' => (string)$this->id,

            'attributes' => [
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'username' => $this->username,
                'email' => $this->email,
                'birthday' => $this->birthday,
//                'api_token' => $this->api_token,
            ],

            // TODO: Add relationships
            'relationships' => [
                //
            ],

            'links' => [
                'self' => route('user.show', ['user' => $this->id]),
                'related' => null,
            ]
        ];
    }
}
