<?php

namespace App\Components\Common\Contracts;

interface RepositoryInterface
{
    public function all();

    public function paginate();

    public function getById(int $id);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function deleteSoft(int $id);
}
