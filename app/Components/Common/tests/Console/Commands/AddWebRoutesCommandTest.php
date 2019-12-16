<?php

namespace App\Components\Common\tests\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\Testing\Traits\ComponentTestTrait;
use App\Components\Common\Testing\TestCase;

/**
 * @group Common
 */
class AddWebRoutesCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = ComponentHelper::getCount();
        $this->addWebRoutes();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_adds_web_route_file(): void
    {
        $countBefore = $this->countFilesByName('web.php');
        $this->addWebRoutes();

        $countAfter = $this->countFilesByName('web.php');
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /**
     * Runs the add:web-routes command.
     */
    private function addWebRoutes(): void
    {
        $this->artisan('add:web-routes', [
            'component' => $this->sampleComponentName
        ]);
    }
}
