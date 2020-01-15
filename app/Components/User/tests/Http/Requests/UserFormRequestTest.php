<?php

namespace App\Components\User\tests\Http\Requests;

use App\Components\Common\Testing\TestCase;
use App\Components\Common\Testing\Traits\RequestTestTrait;
use App\Components\User\Http\Requests\UserFormRequest;

/**
 * @group User
 */
class UserFormRequestTest extends TestCase
{
    use RequestTestTrait;

    /**
     * Returns the validation rules.
     *
     * @return UserFormRequest
     */
    function Validation()
    {
        return new UserFormRequest();
    }

    /** @test */
    function test_request_contains_all_fields(): void
    {
        self::assertArrayHasKey('firstname', $this->rules);
        self::assertArrayHasKey('lastname', $this->rules);
        self::assertArrayHasKey('username', $this->rules);
        self::assertArrayHasKey('email', $this->rules);
        self::assertArrayHasKey('birthday', $this->rules);
    }

    /** @test */
    function test_validation_rules(): void
    {
        self::assertEquals([
            'firstname' => 'required|alpha|min:1|max:255',
            'lastname'  => 'required|alpha|min:1|max:255',
            'username'  => 'required|alpha_num|unique:users|min:3|max:255',
            'email'     => 'required|email|unique:users|max:255',
            'birthday'  => 'nullable|date',
            'password'  => 'required|confirmed|max:255'
        ], $this->rules);
    }

    /** @test */
    function test_testAuthorize(): void
    {
        self::assertTrue($this->Validation()->authorize());
    }
}
