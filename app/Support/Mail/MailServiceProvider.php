<?php

namespace Plugin\Support\Mail;

use Parsedown;
use PHPMailer\PHPMailer\PHPMailer;
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
            $mailer = new Mailer($app['events']);

            // Next we will set all of the global addresses on this mailer, which allows
            // for easy unification of all "from" addresses as well as easy debugging
            // of sent messages since these will be sent to a single email address.
            //foreach (['from', 'replyTo', 'to'] as $type) {
            //    $this->setGlobalAddress($mailer, $app['config']['mail'], $type);
            //}

            // set the global from address and name independently to the mailer
            // class. This will make ALL emails be sent from the global from
            // rather than just mails sent with the mailer class.
            //$app['events']->listen('wp_mail_from', function () use ($app) {
            //    return $app['config']['mail.from.address'];
            //});
            //$app['events']->listen('wp_mail_from_name', function () use ($app) {
            //    return $app['config']['mail.from.name'];
            //});

            return $mailer;
        });

        $this->app->singleton('markdown', function () {
            return new Parsedown();
        });
    }

    ///**
    // * Set a global address on the mailer by type.
    // *
    // * @param  \Atomic\Mail\Mailer  $mailer
    // * @param  array  $config
    // * @param  string  $type
    // * @return void
    // */
    //protected function setGlobalAddress($mailer, array $config, string $type)
    //{
    //    $address = null; //Arr::get($config, $type, $this->app['config']['mail.' . $type]);
    //
    //    if (is_array($address) && isset($address['address'])) {
    //        $mailer->{'always' . ucfirst($type)}($address['address'], $address['name']);
    //    }
    //}

    /**
     * Boot the service provider
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app['events']->listen('phpmailer_init', function (PHPMailer $mailer) {
            $mailer->CharSet = 'UTF-8';
            $mailer->Encoding = 'base64';
        });

        $this->commands([
            \Plugin\Support\Mail\Console\MakeMail::class,
        ]);

        $this->publishes([
            __DIR__ . '/resources/views' => $this->app->basePath('views/vendor/mail'),
        ], 'mail');
    }
}
