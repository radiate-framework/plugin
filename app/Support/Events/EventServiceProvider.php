<?php

namespace Plugin\Support\Events;

use Plugin\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register the services
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('events', function () {
            return new Dispatcher();
        });
    }
}
