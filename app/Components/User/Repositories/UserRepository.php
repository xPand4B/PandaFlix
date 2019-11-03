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
        return new UserCollection(
            User::all()
        );
    }

    public function paginate()
    {
        return new UserCollection(
            User::paginate()
        );
    }

    public function getById($id)
    {
        return new UserResource(
            User::findOrFail($id)
        );
    }

    public function update($id, array $data)
    {
        //
    }

    public function delete($id)
    {
        //
    }

    public function deleteSoft($id)
    {
        //
    }


}
