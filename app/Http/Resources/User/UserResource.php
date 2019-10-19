<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'user',
            'id' => (string)$this->id,

            'attributes' => [
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'fullname' => $this->firstname . ' ' . $this->lastname,
                'username' => $this->username,
                'email' => $this->email,
                'birthday' => $this->birthday,
                'avatar' => $this->avatar,
                'locale' => $this->locale,
                'api_token' => $this->api_token
            ],

            'relationships' => [
                // TODO: Add relationships
            ]
        ];
    }
}
