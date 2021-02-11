<?php

namespace Plugin\Support\Auth\Middleware;

use Closure;
use Plugin\Support\Foundation\Http\Exceptions\HttpResponseException;
use Plugin\Support\Http\Request;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Plugin\Support\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_user_logged_in()) {
            return $next($request);
        }

        throw new HttpResponseException('Unauthorised.', 401);
    }
}
