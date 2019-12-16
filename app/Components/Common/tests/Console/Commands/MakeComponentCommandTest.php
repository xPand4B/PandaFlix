<?php

namespace App\Components\Common\tests\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\Testing\Traits\ComponentTestTrait;
use App\Components\Common\Testing\TestCase;

/**
 * @group Common
 */
class MakeComponentCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeSampleComponent();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_all_files(): void
    {
        $this->makeSampleComponent();

        $files = $this->getComponentFiles($this->sampleComponentName);

        for ($i = 0; $i < sizeof($files); $i++) {
            self::assertSame($this->sampleComponentFiles[$i], $files[$i]);
        }

        $this->deleteSampleComponent();
    }

    /** @test */
    public function test_command_makes_api_route_files(): void
    {
        $countBefore = $this->countFilesByName('api.php');
        $this->makeSampleComponent();

        $countAfter = $this->countFilesByName('api.php');
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_web_route_files(): void
    {
        $countBefore = $this->countFilesByName('web.php');
        $this->makeSampleComponent();

        $countAfter = $this->countFilesByName('web.php');
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /**
     * Runs the make:component command.
     */
    private function makeSampleComponent(): void
    {
        $this->artisan('make:component', [
            'name' => $this->sampleComponentName
        ]);
    }
}
