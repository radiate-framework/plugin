<?php

namespace Plugin\Support\Events;

use Plugin\Support\Support\ServiceProvider;

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

    /**
     * Boot the provider
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            \Plugin\Support\Events\Console\MakeEvent::class,
            \Plugin\Support\Events\Console\MakeListener::class,
            \Plugin\Support\Events\Console\MakeSubscriber::class,
        ]);
    }
}
