<?php

namespace App\Components\User\Repositories;

use App\Components\User\Database\User;
use App\Components\Common\Contracts\RepositoryInterface;
use App\Components\User\Http\Resources\UserCollection;
use App\Components\User\Http\Resources\UserResource;

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
        // TODO: Add update method + validation
    }

    public function delete($id)
    {
        // TODO: Add delete method + validation
    }

    public function deleteSoft($id)
    {
        // TODO: Add soft delete method + validation
    }


}
