<?php

namespace App\Http\Middleware\API;

use Closure;
use App\Node;

class VerifyServer
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
		Node::where('token', $request->token)->firstOrFail();

		return $next($request);
	}
}
