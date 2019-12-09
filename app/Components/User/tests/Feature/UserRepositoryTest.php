<?php

namespace App\Components\User\tests\Unit;

use App\Components\Common\tests\TestCase;
use App\Components\User\Database\User;
use App\Components\User\Repositories\UserRepository;
use App\Components\User\tests\UserTestCaseTrait;

/**
 * @group User
 */
class UserRepositoryTest extends TestCase
{
    use UserTestCaseTrait;

    /** @test */
    public function test_repository_returns_all_users()
    {
        $this->createUser(3);

        self::assertCount(3, (new UserRepository())->all());
    }

    /** @test */
    public function test_repository_returns_all_user_paginated()
    {
        // First run, 15 users
        $this->createUser(15);
        // Paginates 15 per page
        self::assertCount(15, (new UserRepository())->paginate());

        // Second run, add 15 for a total of 30 users
        $this->createUser(15);
        // Due to pagination, still 15 users on the first page
        self::assertCount(15, (new UserRepository())->paginate());
    }

    /** @test */
    public function test_repository_get_user_by_id()
    {
        $this->createUser(5);

        $userId = User::first()->id;
        $repo = new UserRepository();

        self::assertSame(
            $userId,
            $repo->getById($userId)->id
        );
    }
}
