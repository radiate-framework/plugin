<?php

namespace Plugin\Support\Foundation\Providers;

use Plugin\Support\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Boot the services
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            \Plugin\Support\Foundation\Console\MakeProvider::class,
            \Plugin\Support\Foundation\Console\VendorPublish::class,
        ]);
    }
}
