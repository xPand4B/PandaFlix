<?php

namespace App\Components\Common\tests\Console\Commands;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\Testing\Traits\ComponentTestTrait;
use App\Components\Common\Testing\TestCase;

/**
 * @group Common
 */
class MakeRequestCommandTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_command_makes_component_if_not_exist(): void
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeRequest();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_command_makes_request_and_test(): void
    {
        $countBefore = ComponentHelper::getFilesByName($this->sampleComponentName);
        $this->makeRequest();

        $componentFiles = $this->getComponentFiles($this->sampleComponentName);

        $countAfter = ComponentHelper::getFilesByName($this->sampleComponentName);
        $this->deleteSampleComponent();

        self::assertSame([
            $this->getSampleRequestName(),
            $this->getSampleRequestName() . 'Test'
        ], $componentFiles);
        self::assertSame(sizeof($countAfter), sizeof($countBefore) + 2);
    }

    /** @test */
    public function test_file_has_correct_path(): void
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
