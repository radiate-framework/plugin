<?php

namespace Plugin\Support\Console;

use Plugin\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * The commands to register
     *
     * @var array
     */
    protected $commands = [
        \Plugin\Support\Console\Commands\MakeController::class,
        \Plugin\Support\Console\Commands\MakeProvider::class,
    ];

    /**
     * Register the provider
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->commands as $command) {
            $this->app->singleton($command, function ($app) use ($command) {
                return new $command($app, $app['files']);
            });
        }
    }

    /**
     * Boot the services
     *
     * @return void
     */
    public function boot()
    {
        if (class_exists('WP_CLI')) {
            foreach ($this->commands as $command) {
                $this->app[$command]->register();
            }
        };
    }
}
