<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VerifyAdmin
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
		if (Auth::check() && Auth::user()->role === 'admin') {
			return $next($request);
		}
		abort(403, __('auth.credential_required'));
		Log::notice('failed admin operation from IP "' . $request->ip() . '"');
	}
}
