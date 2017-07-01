<?php

namespace App\Http\Middleware\API;

use Closure;
use App\Node;
use Illuminate\Support\Facades\Route;

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
		$node = Node::where('token', $request->token)->firstOrFail();

		if (preg_match('/' . $node->type . '/', Route::current()->uri())) {
			$request->merge(['node' => $node]);

			return $next($request);
		}

		abort(404);
	}
}
