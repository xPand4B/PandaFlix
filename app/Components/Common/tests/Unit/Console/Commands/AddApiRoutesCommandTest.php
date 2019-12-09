<?php

namespace App\Components\Common\tests\Unit\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\tests\ComponentTestTrait;
use App\Components\Common\tests\TestCase;

/**
 * @group Common
 */
class AddApiRoutesCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_adds_component_if_not_exist()
    {
        $countBefore = ComponentHelper::getCount();
        $this->addApiRoutes();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /** @test */
    public function test_command_adds_api_route_file()
    {
        $countBefore = $this->countFilesByName('api.php');
        $this->addApiRoutes();

        $countAfter = $this->countFilesByName('api.php');
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
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
