<?php

namespace App\Components\Common\tests\Unit\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\tests\ComponentTestTrait;
use App\Components\Common\tests\TestCase;

/**
 * @group Common
 */
class MakeRequestCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist()
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeRequest();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /** @test */
    public function test_command_makes_request()
    {
        $countBefore = ComponentHelper::getFilesByName($this->getSampleRequestName());
        $this->makeRequest();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->getSampleRequestName());
        $this->deleteSampleComponent();

        self::assertSame([$this->getSampleRequestName()], $componentFiles);
        self::assertSame(sizeof($countBefore) + 1, sizeof($countAfter));
    }

    /** @test */
    public function test_file_has_correct_path()
    {
        $this->makeRequest();
        $sampleFile = ComponentHelper::getFilesByName($this->getSampleRequestName());
        $this->deleteSampleComponent();

        self::assertStringContainsString(
            $this->sampleComponentName.DIRECTORY_SEPARATOR.$this->getSampleRequestName(),
            $sampleFile[0]
        );
    }

    /**
     * Runs the make:request command.
     */
    private function makeRequest(): void
    {
        $this->artisan('make:request', [
            'name' => $this->getSampleRequestName(),
            'component' => $this->sampleComponentName
        ]);
    }

    /**
     * Returns the sample request class name.
     *
     * @return string
     */
    private function getSampleRequestName(): string
    {
        return $this->sampleComponentName . 'Request';
    }
}
