<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccessController extends Controller
{
	/**
	 * Get the guard to be used during authentication.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard()
	{
		return Auth::guard('api');
	}

	public function logout(Request $request)
	{
		if (!$this->guard()->check()) {
			return response([
				'message' => 'No active user session was found'
			], 404);
		}

		// Taken from: https://laracasts.com/discuss/channels/laravel/laravel-53-passport-password-grant-logout
		$request->user('api')->token()->revoke();

		Auth::guard()->logout();

		Session::flush();

		Session::regenerate();

		return response([
			'message' => 'User was logged out'
		]);
	}

	public function check(Request $request)
	{
		$user = $request->user('api');

		if ($user) {
			return $user;
		} else {
			return response()->json([
				'unauthenticated' => true
			], 401);
		}
	}
}
