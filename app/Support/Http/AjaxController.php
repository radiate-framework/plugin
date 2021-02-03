<?php

namespace Plugin\Support\Http;

abstract class AjaxController
{
    /**
     * The AJAX action
     *
     * @var string
     */
    protected $action;

    /**
     * Create the AJAX controller
     */
    public function __construct()
    {
        add_action("wp_ajax_{$this->action}", [$this, 'handle']);
        add_action("wp_ajax_nopriv_{$this->action}", [$this, 'handle']);
    }

    /**
     * Handle the controller action
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
