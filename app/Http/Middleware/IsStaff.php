<?php

namespace App\Http\Middleware;

use Closure;

class IsStaff
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
		if ($request->user('api')->admin !== 1) {
			return response()->json(['error' => 'Insufficient authorization'], 401);
		}
		return $next($request);
	}
}
