<?php

namespace App\Http\Middleware\Admin;

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
		if (Auth::check() && Auth::user()->isAdmin()) {
			return $next($request);
		}
		abort(403, __('auth.credential_required'));
		Log::warning('failed admin operation from IP "' . $request->ip() . '"');
	}
}
