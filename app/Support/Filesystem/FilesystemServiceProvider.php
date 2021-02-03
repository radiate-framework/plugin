<?php

namespace Plugin\Support\Filesystem;

use Plugin\Support\ServiceProvider;

class FilesystemServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->instance('files', new Filesystem());
    }
}
