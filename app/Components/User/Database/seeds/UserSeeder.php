<?php

namespace App\Components\User\Database\Seeds;

use App\Components\User\Database\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, User::$seed_count)->create();
    }
}
