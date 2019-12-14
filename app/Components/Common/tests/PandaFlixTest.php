<?php declare(strict_types=1);

namespace App\Components\Common\tests\Unit;

use App\Components\Common\PandaFlix;
use App\Components\Common\Testing\TestCase;

/**
 * @group Common
 */
class PandaFlixTest extends TestCase
{
    /** @test */
    public function test_additional_resource_data_can_be_generated(): void
    {
        $response = PandaFlix::ResourceAdditions();

        self::assertSame([
            'version' => PandaFlix::VERSION,
            'success' => (boolean)true
        ], $response);
    }

    /** @test */
    public function test_component_path_exists(): void
    {
        $componentPath = PandaFlix::ComponentPath();

        self::assertSame(true, is_dir($componentPath));
    }
}
