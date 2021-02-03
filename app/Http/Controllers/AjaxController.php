<?php

namespace Plugin\Http\Controllers;

use Plugin\Support\Http\AjaxController as Controller;

class AjaxController extends Controller
{
    /**
     * The AJAX action
     *
     * @var string
     */
    protected $action = 'test_ajax';

    /**
     * Handle the controller action
     *
     * @return void
     */
    public function handle()
    {
        return \Plugin\view('index', ['test' => 'world!']);
    }
}
