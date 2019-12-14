<?php

namespace App\Components\Common\tests\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\Testing\Traits\ComponentTestTrait;
use App\Components\Common\Testing\TestCase;

/**
 * @group Common
 */
class MakeTestCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeTest();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_unit_tests(): void
    {
        $countBefore = ComponentHelper::getFilesByName($this->getSampleUnitTestName());
        $this->makeTest();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->getSampleUnitTestName());
        $this->deleteSampleComponent();

        self::assertSame([$this->getSampleUnitTestName()], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 1);
    }

    /** @test */
    public function test_file_has_correct_path(): void
    {
        $this->makeTest();
        $sampleFile = ComponentHelper::getFilesByName($this->getSampleUnitTestName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.$this->getSampleUnitTestName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:test command.
     */
    private function makeTest(): void
    {
        $this->artisan('make:test', [
            'name' => $this->getSampleUnitTestName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample resource class name.
     *
     * @return string
     */
    private function getSampleUnitTestName(): string
    {
        return $this->sampleComponentName . 'UnitTest';
    }
}
