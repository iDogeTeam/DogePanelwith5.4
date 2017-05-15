<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyActive
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Auth::check() && ($status = Auth::user()->status) === 'enable') {
			return $next($request);
		}

		return Response()->json(['code' => '422', 'status' => $status]);
	}
}
