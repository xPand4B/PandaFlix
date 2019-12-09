<?php

namespace App\Components\Common\tests\Unit\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\tests\ComponentTestTrait;
use App\Components\Common\tests\TestCase;

/**
 * @group Common
 */
class MakeRepositoryCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist()
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeRepository();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /** @test */
    public function test_command_makes_repository()
    {
        $countBefore = ComponentHelper::getFilesByName($this->getSampleRepositoryName());
        $this->makeRepository();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->getSampleRepositoryName());
        $this->deleteSampleComponent();

        self::assertSame([
            $this->sampleComponentName,
            $this->getSampleRepositoryName()
        ], $componentFiles);
        self::assertSame(sizeof($countBefore) + 1, sizeof($countAfter));
    }

    /** @test */
    public function test_file_has_correct_path()
    {
        $this->makeRepository();
        $sampleFile = ComponentHelper::getFilesByName($this->getSampleRepositoryName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'Repositories'.DIRECTORY_SEPARATOR.$this->getSampleRepositoryName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:repository command.
     */
    private function makeRepository(): void
    {
        $this->artisan('make:repository', [
            'name' => $this->getSampleRepositoryName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample repository class name.
     *
     * @return string
     */
    private function getSampleRepositoryName(): string
    {
        return $this->sampleComponentName . 'Repository';
    }
}
