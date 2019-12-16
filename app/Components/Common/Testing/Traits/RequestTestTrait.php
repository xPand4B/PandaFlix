<?php

namespace App\Components\Common\Testing\Traits;

trait RequestTestTrait
{
    /**
     * @var array
     */
    public $rules;

    /**
     * @var Validator
     */
    public $validator;

    public function setUp(): void
    {
        $this->validator = $this->app['validator'];
        $this->rules = $this->Validation()->rules();
        parent::setUp();
    }

    /**
     * Returns the validation request.
     *
     * @return mixed
     */
    abstract function Validation();

    /** @test */
    abstract function test_request_contains_all_fields(): void;

    /** @test */
    abstract function test_validation_rules(): void;

    /** @test */
    abstract function test_testAuthorize(): void;
}
