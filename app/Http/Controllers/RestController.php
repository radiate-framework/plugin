<?php

namespace Plugin\Http\Controllers;

use Plugin\Support\Http\Request;

class RestController
{
    /**
     * Handle the controller action
     *
     * @param \Plugin\Support\Http\Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $request->add('type', 'rest');

        return $request;
    }
}
