<?php

namespace App\Components\Common\tests\Unit\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\tests\ComponentTestTrait;
use App\Components\Common\tests\TestCase;

/**
 * @group Common
 */
class MakeControllerCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist()
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeController();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /** @test */
    public function test_command_makes_controller()
    {
        $countBefore = ComponentHelper::getFilesByName($this->getSampleControllerName());
        $this->makeController();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->getSampleControllerName());
        $this->deleteSampleComponent();

        self::assertSame([$this->getSampleControllerName()], $componentFiles);
        self::assertSame(sizeof($countBefore) + 1, sizeof($countAfter));
    }

    /** @test */
    public function test_file_has_correct_path()
    {
        $this->makeController();
        $sampleFile = ComponentHelper::getFilesByName($this->getSampleControllerName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.$this->getSampleControllerName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:controller command.
     */
    private function makeController(): void
    {
        $this->artisan('make:controller', [
            'name' => $this->getSampleControllerName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample controller class name.
     *
     * @return string
     */
    private function getSampleControllerName(): string
    {
        return $this->sampleComponentName . 'Controller';
    }
}
