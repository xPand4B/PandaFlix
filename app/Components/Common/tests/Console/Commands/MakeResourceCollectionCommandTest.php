<?php

namespace App\Components\Common\tests\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\Testing\Traits\ComponentTestTrait;
use App\Components\Common\Testing\TestCase;

/**
 * @group Common
 */
class MakeResourceCollectionCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeCollection();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_collection_and_test(): void
    {
        $countBefore = ComponentHelper::getFilesByName($this->sampleComponentName);
        $this->makeCollection();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->sampleComponentName);
        $this->deleteSampleComponent();

        self::assertSame([
            $this->getSampleCollectionName(),
            $this->getSampleCollectionName() . 'Test'
        ], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 2);
    }

    /** @test */
    public function test_file_has_correct_path(): void
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
