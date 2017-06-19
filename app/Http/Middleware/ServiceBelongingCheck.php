<?php

namespace App\Http\Middleware;

use Closure;
use App\UserService;

class ServiceBelongingCheck
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
		if (!($service = UserService::where('id', $request->sid)->first())) {
			return formatter(404, __('service.service_no_found'));
		}

		if ($service->isUserHasService($request->user()->id)) {
			$request->merge(['service' => $service]);
			return $next($request);
		}

		return formatter(403,__('service.service_does_not_belong_to_user'));

	}
}
