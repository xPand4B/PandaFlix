<?php

namespace App\PandaFlix\Contracts;

interface RepositoryInterface
{
    public static function all();

    public static function findById(int $id);
}
