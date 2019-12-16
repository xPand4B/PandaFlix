<?php declare(strict_types=1);

namespace App\Components\Common\Testing\Traits;

use App\Components\User\Database\User;

trait UserTestCaseTrait
{
    /**
     * Returns a new user.
     *
     * @param int $count
     * @param array $overrides
     *
     * @return mixed
     */
    public function createUser(int $count = 1, array $overrides = [])
    {
        return factory(User::class, $count)->create($overrides);
    }
}
