<?php

namespace App\Components\Common\tests\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\Testing\Traits\ComponentTestTrait;
use App\Components\Common\Testing\TestCase;

/**
 * @group Common
 */
class MakeResourceCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeResource();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_resource_and_test(): void
    {
        $countBefore = ComponentHelper::getFilesByName($this->sampleComponentName);
        $this->makeResource();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->sampleComponentName);
        $this->deleteSampleComponent();

        self::assertSame([
            $this->getSampleResourceName(),
            $this->getSampleResourceName() . 'Test'
        ], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 2);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeResource();
        $sampleFile = ComponentHelper::getFilesByName($this->getSampleResourceName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.$this->getSampleResourceName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:resource command.
     */
    private function makeResource(): void
    {
        $this->artisan('make:resource', [
            'name' => $this->getSampleResourceName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample resource class name.
     *
     * @return string
     */
    private function getSampleResourceName(): string
    {
        return $this->sampleComponentName . 'Collection';
    }
}
