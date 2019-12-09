<?php

namespace App\Components\Common\tests\Unit\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\tests\ComponentTestTrait;
use App\Components\Common\tests\TestCase;

/**
 * @group Common
 */
class MakeResourceCollectionCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist()
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeCollection();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /** @test */
    public function test_command_makes_collection()
    {
        $countBefore = ComponentHelper::getFilesByName($this->getSampleCollectionName());
        $this->makeCollection();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->getSampleCollectionName());
        $this->deleteSampleComponent();

        self::assertSame([$this->getSampleCollectionName()], $componentFiles);
        self::assertSame(sizeof($countBefore) + 1, sizeof($countAfter));
    }

    /** @test */
    public function test_file_has_correct_path()
    {
        $this->makeCollection();
        $sampleFile = ComponentHelper::getFilesByName($this->getSampleCollectionName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.$this->getSampleCollectionName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:resource command.
     */
    private function makeCollection(): void
    {
        $this->artisan('make:resource', [
            'name' => $this->getSampleCollectionName(),
            'component' => $this->sampleComponentName,
            'collection'
        ]);
    }

    /**
     * Returns the sample resource class name.
     *
     * @return string
     */
    private function getSampleCollectionName(): string
    {
        return $this->sampleComponentName . 'Collection';
    }
}
