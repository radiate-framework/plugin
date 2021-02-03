<?php

namespace Plugin\Support\Console\Commands;

use Plugin\Support\Application;
use WP_CLI;

abstract class Command
{
    /**
     * The app instance
     *
     * @var \Plugin\Support\Application
     */
    protected $app;

    /**
     * The command
     *
     * @var string
     */
    protected $command = '';

    /**
     * Create the command instance
     *
     * @param \Plugin\Support\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Register a command
     *
     * @return void
     */
    public function register()
    {
        WP_CLI::add_command('plugin-cli ' . $this->command, $this);
    }

    /**
     * Display a success message
     *
     * @param string $message
     * @return void
     */
    protected function success(string $message)
    {
        WP_CLI::success($message);
    }

    /**
     * Dispaly an error message
     *
     * @param string $message
     * @return void
     */
    protected function error(string $message)
    {
        WP_CLI::error($message);
    }
}
