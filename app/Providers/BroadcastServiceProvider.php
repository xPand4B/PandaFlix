<?php

namespace App\Providers;

use App\Components\Common\PandaFlix;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        require PandaFlix::ComponentPath('Common/routes/channels.php');
    }
}
