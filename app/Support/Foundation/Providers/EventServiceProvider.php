<?php

namespace Plugin\Support\Foundation\Providers;

use Plugin\Support\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [];

    /**
     * Register the application's event listeners.
     *
     * @return void
     */
    public function boot(): void
    {
        foreach ($this->listen as $event => $listeners) {
            foreach (array_unique($listeners) as $listener) {
                $this->app['events']->listen($event, $listener);
            }
        }

        foreach ($this->subscribe as $subscriber) {
            $this->app['events']->subscribe($subscriber);
        }
    }
}
