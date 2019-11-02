<?php

namespace App\Components\User\Repositories;

use App\Components\User\Database\User;
use App\Components\User\Resources\UserResource;
use App\Components\User\Resources\UserCollection;
use App\Components\Common\Contracts\RepositoryInterface;

class UserRepository implements RepositoryInterface
{
    public function all()
    {
        return 'test';
        return UserCollection::collection(
            User::all()
        );
    }

    public function paginate()
    {
        return 'test';
        return UserCollection::collection(
            User::paginate()
        );
    }

    public function getById(int $id)
    {
        return new UserResource(
            User::findOrFail($id)
        );
    }

    public function update(int $id, array $data)
    {
        //
    }

    public function delete(int $id)
    {
        //
    }

    public function deleteSoft(int $id)
    {
        //
    }


}
