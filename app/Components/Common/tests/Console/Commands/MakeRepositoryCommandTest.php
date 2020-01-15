<?php

namespace App\Components\Common\tests\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\Testing\Traits\ComponentTestTrait;
use App\Components\Common\Testing\TestCase;

/**
 * @group Common
 */
class MakeRepositoryCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeRepository();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_repository_plus_model_and_test(): void
    {
        $countBefore = ComponentHelper::getFilesByName($this->sampleComponentName);
        $this->makeRepository();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->sampleComponentName);
        $this->deleteSampleComponent();

        self::assertSame([
            $this->getSampleRepositoryName(),
            $this->getSampleRepositoryName() . 'Test'
        ], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 2);
    }

    /** @test */
    public function test_file_has_correct_path(): void
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
