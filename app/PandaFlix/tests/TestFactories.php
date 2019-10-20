<?php

namespace App\PandaFlix\Tests;

use App\PandaFlix\Models\User;
use App\PandaFlix\Models\Movie;
use App\PandaFlix\Models\Serie;
use App\PandaFlix\Models\Episode;
use App\PandaFlix\Models\Category;
use App\PandaFlix\Models\Collection;

trait TestFactories
{
    /**
     * Returns an user.
     *
     * @param array $overrides
     * @param int $count
     * @return mixed
     */
    protected function user(array $overrides = [], int $count = 1)
    {
        return factory(User::class, $count)->create($overrides);
    }

    /**
     * Returns an category.
     *
     * @param array $overrides
     * @param int $count
     * @return mixed
     */
    protected function category(array $overrides = [], int $count = 1)
    {
        return factory(Category::class, $count)->create($overrides);
    }

    /**
     * Returns an collection.
     *
     * @param array $overrides
     * @param int $count
     * @return mixed
     */
    protected function collection(array $overrides = [], int $count = 1)
    {
        return factory(Collection::class, $count)->create($overrides);
    }

    /**
     * Returns an episode.
     *
     * @param array $overrides
     * @param int $count
     * @return mixed
     */
    protected function episode(array $overrides = [], int $count = 1)
    {
        return factory(Episode::class, $count)->create($overrides);
    }

    /**
     * Returns an movie.
     *
     * @param array $overrides
     * @param int $count
     * @return mixed
     */
    protected function movie(array $overrides = [], int $count = 1)
    {
        return factory(Movie::class, $count)->create($overrides);
    }

    /**
     * Returns an serie.
     *
     * @param array $overrides
     * @param int $count
     * @return mixed
     */
    protected function serie(array $overrides = [], int $count = 1)
    {
        return factory(Serie::class, $count)->create($overrides);
    }
}
