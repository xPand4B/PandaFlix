<?php

namespace App\Components\Common\tests\Unit\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\tests\ComponentTestTrait;
use App\Components\Common\tests\TestCase;

/**
 * @group Common
 */
class MakeUnitTestCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist()
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeFeatureTest();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /** @test */
    public function test_command_makes_unit_tests()
    {
        $countBefore = ComponentHelper::getFilesByName($this->getSampleUnitTestName());
        $this->makeFeatureTest();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->getSampleUnitTestName());
        $this->deleteSampleComponent();

        self::assertSame([$this->getSampleUnitTestName()], $componentFiles);
        self::assertSame(sizeof($countBefore) + 1, sizeof($countAfter));
    }

    /** @test */
    public function test_file_has_correct_path()
    {
        $this->makeFeatureTest();
        $sampleFile = ComponentHelper::getFilesByName($this->getSampleUnitTestName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'Unit'.DIRECTORY_SEPARATOR.$this->getSampleUnitTestName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:test command.
     */
    private function makeFeatureTest(): void
    {
        $this->artisan('make:test', [
            'name' => $this->getSampleUnitTestName(),
            'component' => $this->sampleComponentName,
            '--unit' => 'default'
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
