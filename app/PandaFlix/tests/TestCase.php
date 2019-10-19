<?php

namespace App\PandaFlix\Tests;

use App\PandaFlix\Models\Movie;
use App\PandaFlix\Models\Serie;
use App\PandaFlix\Models\Episode;
use App\PandaFlix\Models\Category;
use App\PandaFlix\Models\Collection;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use TestParameter, TestFactories, CreatesApplication;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Acting as an user
     *
     * @param string|null $driver
     * @return TestCase
     */
    protected function actingAsUser(string $driver = null): TestCase
    {
        $this->actingAs($this->user(), $driver);

        return $this;
    }

    /**
     * Assert count for all models in one method.
     *
     * @param int $userCount
     * @param int $collectionCount
     * @param int $episodeCount
     * @param int $movieCount
     * @param int $serieCount
     * @return TestCase
     */
    protected function assertModelCount(
        int $userCount,
        int $collectionCount,
        int $episodeCount,
        int $movieCount,
        int $serieCount
    ): TestCase
    {
        $this->assertCount($userCount, Category::all());
        $this->assertCount($collectionCount, Collection::all());
        $this->assertCount($episodeCount, Episode::all());
        $this->assertCount($movieCount, Movie::all());
        $this->assertCount($serieCount, Serie::all());

        return $this;
    }
}
