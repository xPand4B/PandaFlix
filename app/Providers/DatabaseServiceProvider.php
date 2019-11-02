<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    public $factories_path = 'app/Components/Common/Database/factories';

    /**
     * @var string
     */
    public $migrations_path = 'app/Components/Common/Database/migrations';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(EloquentFactory::class, function ($app) {
            $faker = $app->make(FakerGenerator::class);
            return EloquentFactory::construct($faker, base_path($this->factories_path));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(base_path($this->migrations_path));
    }
}
