<?php

namespace App\Components\Common\tests\Unit\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\tests\ComponentTestTrait;
use App\Components\Common\tests\TestCase;

/**
 * @group Common
 */
class AddWebRoutesCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_adds_component_if_not_exist()
    {
        $countBefore = ComponentHelper::getCount();
        $this->addWebRoutes();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /** @test */
    public function test_command_adds_web_route_file()
    {
        $countBefore = $this->countFilesByName('web.php');
        $this->addWebRoutes();

        $countAfter = $this->countFilesByName('web.php');
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /**
     * Runs the add:web-routes command.
     */
    private function addWebRoutes()
    {
        $this->artisan('add:web-routes', [
            'component' => $this->sampleComponentName
        ]);
    }
}
