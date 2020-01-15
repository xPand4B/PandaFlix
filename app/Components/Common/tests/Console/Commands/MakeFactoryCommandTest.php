<?php

namespace App\Components\Common\tests\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\Testing\TestCase;
use App\Components\Common\Testing\Traits\ComponentTestTrait;

class MakeFactoryCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeFactory();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_controller_and_test(): void
    {
        $countBefore = ComponentHelper::getFilesByName($this->sampleComponentName);
        $this->makeFactory();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->sampleComponentName);
        $this->deleteSampleComponent();

        self::assertSame([
            $this->getSampleFactoryName(),
            $this->getSampleFactoryName() . 'Test'
        ], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 2);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeFactory();
        $sampleFile = ComponentHelper::getFilesByName($this->getSampleFactoryName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'Database'.DIRECTORY_SEPARATOR.'factories'.DIRECTORY_SEPARATOR.$this->getSampleFactoryName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:factory command.
     */
    private function makeFactory(): void
    {
        $this->artisan('make:factory', [
            'name' => $this->getSampleFactoryName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample controller class name.
     *
     * @return string
     */
    private function getSampleFactoryName(): string
    {
        return $this->sampleComponentName . 'Factory';
    }
}
