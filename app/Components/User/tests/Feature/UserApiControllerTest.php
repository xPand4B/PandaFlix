<?php

namespace App\Components\User\tests\Feature;

use App\Components\Common\PandaFlix;
use App\Components\Common\tests\TestCase;
use App\Components\User\tests\UserTestCaseTrait;

/**
 * @group User
 */
class UserApiControllerTest extends TestCase
{
    use UserTestCaseTrait;

    /** @test */
    public function test_all_user_can_be_get()
    {
        $this->createUser(2);

        $response = $this->get(route('user.index'))
            ->assertStatus(200)
            ->getContent();

        $response = json_decode($response);

        // TODO: Add assertion for response

        self::assertSame(PandaFlix::ResourceAdditions()['version'], $response->version);
        self::assertSame(PandaFlix::ResourceAdditions()['success'], $response->success);
    }
}
