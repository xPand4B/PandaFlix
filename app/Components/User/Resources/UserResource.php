<?php

namespace App\Components\User\Resources;

use App\Components\User\Database\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request)
    {
        return [
            'type' => User::class,
            'id' => (string)$this->id,

            'attributes' => [
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'username' => $this->username,
                'email' => $this->email,
                'birthday' => $this->birthday,
            ],

            // TODO: Add relationships
            'relationships' => [
                //
            ],

            'links' => [
                'self' => route('user.show', ['user' => $this->id]),
                'related' => 'null'
            ]
        ];
    }
}
