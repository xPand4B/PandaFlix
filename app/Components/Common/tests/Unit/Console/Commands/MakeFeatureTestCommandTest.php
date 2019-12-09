<?php

namespace App\Components\Common\tests\Unit\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\tests\ComponentTestTrait;
use App\Components\Common\tests\TestCase;

/**
 * @group Common
 */
class MakeFeatureTestCommandTest extends TestCase
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
    public function test_command_makes_feature_tests()
    {
        $countBefore = ComponentHelper::getFilesByName($this->getSampleFeatureTestName());
        $this->makeFeatureTest();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->getSampleFeatureTestName());
        $this->deleteSampleComponent();

        self::assertSame([$this->getSampleFeatureTestName()], $componentFiles);
        self::assertSame(sizeof($countBefore) + 1, sizeof($countAfter));
    }

    /** @test */
    public function test_file_has_correct_path()
    {
        $this->makeFeatureTest();
        $sampleFile = ComponentHelper::getFilesByName($this->getSampleFeatureTestName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'Feature'.DIRECTORY_SEPARATOR.$this->getSampleFeatureTestName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:test command.
     */
    private function makeFeatureTest(): void
    {
        $this->artisan('make:test', [
            'name' => $this->getSampleFeatureTestName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample resource class name.
     *
     * @return string
     */
    private function getSampleFeatureTestName(): string
    {
        return $this->sampleComponentName . 'FeatureTest';
    }
}
