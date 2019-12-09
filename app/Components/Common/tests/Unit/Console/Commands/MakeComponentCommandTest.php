<?php

namespace App\Components\Common\tests\Unit\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\tests\ComponentTestTrait;
use App\Components\Common\tests\TestCase;

/**
 * @group Common
 */
class MakeComponentCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component()
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeSampleComponent();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_all_files()
    {
        $this->makeSampleComponent();

        $files = $this->getComponentFiles($this->sampleComponentName);

        for ($i = 0; $i < sizeof($files); $i++) {
            self::assertSame($files[$i], $this->sampleComponentFiles[$i]);
        }

        $this->deleteSampleComponent();
    }

    /** @test */
    public function test_command_makes_api_route_files()
    {
        $countBefore = $this->countFilesByName('api.php');
        $this->makeSampleComponent();

        $countAfter = $this->countFilesByName('api.php');
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /** @test */
    public function test_command_makes_web_route_files()
    {
        $countBefore = $this->countFilesByName('web.php');
        $this->makeSampleComponent();

        $countAfter = $this->countFilesByName('web.php');
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
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
