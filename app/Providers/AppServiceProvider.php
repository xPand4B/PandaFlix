<?php

namespace App\Providers;

use App\Components\Common\Facades\Components;
use App\Components\Common\Helper\ComponentsHelper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('Components', function() {
            return new ComponentsHelper('app/Components');
        });
    }
}
