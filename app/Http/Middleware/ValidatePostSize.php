<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidatePostSize
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->getContentLength() > $this->maxContentLength()) {
            abort(413, 'Payload Too Large');
        }

        return $next($request);
    }

    /**
     * Get the maximum content length.
     *
     * @return int
     */
    protected function maxContentLength()
    {
        return 10 * 1024 * 1024; // 10 MB
    }
}
