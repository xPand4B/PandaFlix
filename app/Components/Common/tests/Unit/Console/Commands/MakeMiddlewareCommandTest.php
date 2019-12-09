<?php

namespace App\Components\Common\tests\Unit\Console\Commands;

use App\Components\Common\tests\ComponentTestTrait;
use App\Components\Common\tests\TestCase;

/**
 * @group Common
 */
class MakeMiddlewareCommandTest extends TestCase
{
    use ComponentTestTrait;

    // TODO: Add tests

    /**
     * RUns the make:middleware command.
     */
    private function makeMiddleware(): void
    {
        $this->artisan('make:middleware', [
            'name' => $this->getSampleMiddlewareName()
        ]);
    }

    /**
     * Returns the sample middleware class name.
     *
     * @return string
     */
    private function getSampleMiddlewareName(): string
    {
        return $this->sampleComponentName . 'Middleware';
    }
}
