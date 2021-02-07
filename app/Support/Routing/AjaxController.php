<?php

namespace Plugin\Support\Routing;

use Plugin\Support\Http\Request;

abstract class AjaxController extends Controller
{
    /**
     * The AJAX action
     *
     * @var string
     */
    protected $action;

    /**
     * The AJAX guards
     *
     * @var array
     */
    protected $guards = ['AUTH', 'GUEST'];

    /**
     * Dispatch the request to the route
     *
     * @param \Plugin\Support\Http\Request $request
     * @return void
     */
    public function dispatch(Request $request)
    {
        $this->request = $request;

        if (in_array('AUTH', $this->guards)) {
            $this->events->listen("wp_ajax_{$this->action}", [$this, 'runRoute']);
        }
        if (in_array('GUEST', $this->guards)) {
            $this->events->listen("wp_ajax_nopriv_{$this->action}", [$this, 'runRoute']);
        }
    }

    /**
     * Dispatch the route
     *
     * @return void
     */
    public function runRoute()
    {
        die($this->runRequestThroughStack($this->request));
    }
}
