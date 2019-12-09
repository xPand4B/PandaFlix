<?php

use App\Components\User\Database\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call([
            UserSeeder::class
        ]);

        $usersCount  = User::all()->count();

        $this->command->info("\nTotal:");
        $this->command->info("=============");
        $this->command->info("User : {$usersCount}\n");

        Eloquent::reguard();
    }
}
