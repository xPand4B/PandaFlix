<?php

namespace App\Components\Common\tests\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\Testing\TestCase;
use App\Components\Common\Testing\Traits\ComponentTestTrait;

/**
 * @group Common
 */
class AddApiRoutesCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = ComponentHelper::getCount();
        $this->addApiRoutes();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_adds_api_route_file(): void
    {
        $countBefore = $this->countFilesByName('api.php');
        $this->addApiRoutes();

        $countAfter = $this->countFilesByName('api.php');
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /**
     * RUns the add:api-routes command.
     */
    private function addApiRoutes(): void
    {
        $this->artisan('add:api-routes', [
            'component' => $this->sampleComponentName
        ]);
    }
}
