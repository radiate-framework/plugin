<?php

namespace Plugin\Support\Foundation\Http\Middleware;

use Closure;
use Plugin\Support\Http\Request;

class ConvertEmptyStringsToNull
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
        return $next($this->transform($request));
    }

    /**
     * Trim whitespace from the request strings
     *
     * @param \Plugin\Support\Http\Request $request
     * @return \Plugin\Support\Http\Request
     */
    protected function transform(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            $request[$key] = $value === '' ? null : $value;
        }

        return $request;
    }
}
