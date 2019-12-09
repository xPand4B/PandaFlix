<?php

namespace App\Components\Common\tests\Unit\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\tests\ComponentTestTrait;
use App\Components\Common\tests\TestCase;

/**
 * @group Common
 */
class MakeResourceCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist()
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeResource();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /** @test */
    public function test_command_makes_resource()
    {
        $countBefore = ComponentHelper::getFilesByName($this->getSampleResourceName());
        $this->makeResource();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->getSampleResourceName());
        $this->deleteSampleComponent();

        self::assertSame([$this->getSampleResourceName()], $componentFiles);
        self::assertSame(sizeof($countBefore) + 1, sizeof($countAfter));
    }

    /** @test */
    public function test_file_has_correct_path()
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
