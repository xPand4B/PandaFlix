<?php

namespace App\Components\Common\tests\Helper;

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\PandaFlix;
use App\Components\Common\Testing\Traits\ComponentTestTrait;
use App\Components\Common\Testing\TestCase;
use Illuminate\Support\Facades\File;

/**
 * @group Common
 */
class ComponentHelperTest extends TestCase
{
    use ComponentTestTrait;

    /** @test */
    public function test_helper_can_find_all_component_files(): void
    {
        $this->makeSampleComponent();

        $files = $this->getComponentFiles($this->sampleComponentName);

        for ($i = 0; $i < sizeof($files); $i++) {
            self::assertSame($files[$i], $this->sampleComponentFiles[$i]);
        }

        $this->deleteSampleComponent();
    }

    /** @test */
    public function test_helper_returns_null_if_component_not_exists(): void
    {
        $files = $this->getComponentFiles($this->sampleComponentName . 'Fake');
        $this->deleteSampleComponent();

        self::assertEmpty($files);
    }

    /** @test */
    public function test_helper_can_count_components(): void
    {
        $countBefore = ComponentHelper::getCount();
        $this->makeSampleComponent();

        $countAfter = ComponentHelper::getCount();
        $this->deleteSampleComponent();

        self::assertSame($countBefore + 1, $countAfter);
    }

    /** @test */
    public function test_helper_can_get_all_component_names()
    {
        $expected = ComponentHelper::getComponentNames();

        $actual = File::directories(PandaFlix::ComponentPath());

        // Minus one because the helper is ignoring the Common component.
        self::assertSame(sizeof($actual) - 1, sizeof($expected));
    }

    /** @test */
    public function test_helper_can_get_all_route_files(): void
    {
        $this->makeSampleComponent();

        $apiRouteFiles = ComponentHelper::getFilesByName('api.php');
        $webRouteFiles = ComponentHelper::getFilesByName('web.php');

        $this->deleteSampleComponent();

        $sampleRouteFileCount = 0;

        foreach ($apiRouteFiles as $file) {
            $tmp = explode(DIRECTORY_SEPARATOR, $file);
            if ($tmp[sizeof($tmp) - 3] === $this->sampleComponentName) {
                $sampleRouteFileCount++;
            }
        }

        foreach ($webRouteFiles as $file) {
            $tmp = explode(DIRECTORY_SEPARATOR, $file);
            if ($tmp[sizeof($tmp) - 3] === $this->sampleComponentName) {
                $sampleRouteFileCount++;
            }
        }

        self::assertSame(2, $sampleRouteFileCount);
    }

    /**
     * Makes a component.
     */
    private function makeSampleComponent(): void
    {
        $this->artisan('make:component', [
            'name' => $this->sampleComponentName
        ]);
    }
}
