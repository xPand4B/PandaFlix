<?php

namespace App\Components\User\tests\Unit;

use App\Components\Common\tests\TestCase;
use App\Components\User\Database\User;
use App\Components\User\Resources\UserCollection;
use App\Components\User\tests\UserTestCaseTrait;

/**
 * @group User
 */
class UserCollectionTest extends TestCase
{
    use UserTestCaseTrait;

    /** @test */
    public function test_collection_format()
    {
        $this->createUser(2);
        $users = User::all();

        $collection = (new UserCollection(User::all()))->resolve();

        self::assertSame([
            [
                'type' => User::class,
                'id' => (string)$users[0]->id,

                'attributes' => [
                    'firstname' => $users[0]->firstname,
                    'lastname' => $users[0]->lastname,
                    'username' => $users[0]->username,
                    'email' => $users[0]->email,
                    'birthday' => $users[0]->birthday,
                ],

                'relationships' => [],

                'links' => [
                    'self' => route('user.show', ['user' => $users[0]->id]),
                    'related' => null,
                ]
            ],
            [
                'type' => User::class,
                'id' => (string)$users[1]->id,

                'attributes' => [
                    'firstname' => $users[1]->firstname,
                    'lastname' => $users[1]->lastname,
                    'username' => $users[1]->username,
                    'email' => $users[1]->email,
                    'birthday' => $users[1]->birthday,
                ],

                'relationships' => [],

                'links' => [
                    'self' => route('user.show', ['user' => $users[1]->id]),
                    'related' => null,
                ]
            ],
        ], $collection);
    }
}
