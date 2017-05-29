<?php

namespace App\Http\Middleware;

use Closure;
use App\Item;

class VerifyItems
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
		if (!$request->has('token')) {
			return formatter(421, __('general.missing_data'));
		}
		if (!($item = Item::where('token', $request->token)->first())) { // Exist

			return formatter(413, __('general.code_does_not_exist'));
		}

		if (!(($item->started_at < time() || $item->ended_at > time()) || (empty($item->started_at) && empty($item->ended_at)))) { // Within time limit
			return formatter(413, __('general.code_does_not_enable'));
		}

		if (!($item->itemLog()->where('action', 'used')->count() > $item->used_times_limit || $item->used_times_limit = -1)) { // times limits
			return formatter(413, __('general.code_used_up'));
		}

		$request->merge(['item' => $item]);

		return $next($request);
	}
}
