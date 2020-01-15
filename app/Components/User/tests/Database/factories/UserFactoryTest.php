<?php

namespace App\Components\User\tests\Database\factories;

use App\Components\Common\Testing\TestCase;
use App\Components\User\Database\User;

/**
 * @group User
 */
class UserFactoryTest extends TestCase
{
    /** @test  */
    public function test_factory_creates_a_new_user(): void
    {
        $countBefore = User::all()->count();
        factory(User::class, 1)->create();

        $countAfter = User::all()->count();

        self::assertSame($countAfter, $countBefore + 1);
    }
}
