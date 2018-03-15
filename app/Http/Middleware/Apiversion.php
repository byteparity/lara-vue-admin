<?php

namespace App\Http\Middleware;

use Closure;

class APIversion
{
  /**
   * Handle an incoming request.
   *
   * @param  Request $request
   * @param  Closure $next
   *
   * @return mixed
   */
  public function handle($request, $next, $guard)
  {
    config(['app.api_version' => $guard]);
    return $next($request);
  }
}