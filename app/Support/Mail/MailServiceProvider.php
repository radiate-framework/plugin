<?php

namespace Plugin\Support\Mail;

use Parsedown;
use Plugin\Support\ServiceProvider;

class MailServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('mailer', function ($app) {
            return new Mailer($app['events']);
        });

        $this->app->singleton('markdown', function () {
            return new Parsedown();
        });
    }

    /**
     * Boot the service provider
     *
     * @return void
     */
    public function boot(): void
    {
        $this->commands([
            \Plugin\Support\Mail\Console\MakeMail::class,
        ]);

        $this->publishes([
            __DIR__ . '/resources/views' => $this->app->basePath('views/vendor/mail'),
        ], 'mail');
    }
}
