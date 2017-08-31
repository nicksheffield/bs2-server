<?php

namespace App\Http\Middleware;

use Closure;

class APIAuth
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!$request->user('api')) {
			return response()->json(['message' => 'You are not authenticated'], 401);
		}
		return $next($request);
	}
}
