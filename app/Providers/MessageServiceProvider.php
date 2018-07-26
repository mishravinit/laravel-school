<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MessageService;


class MessageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\MessageService', function ($app) {
            return new MessageService();
        });
    }


}
