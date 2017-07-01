<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnyconnectController extends Controller
{
	//

	public function __construct()
	{
	}

	protected function gatherServices(Request $request)
	{
		$services = $request->node->nodeGroup()->first()->services()->get();

		/*$services->transform(function ($service) use ($request) {
			$service->traffic = GBtoByte($service->rest / ($request->node->upload_price + $request->node->download_price));

			return $service;
		});*/

		return $services;
	}

	public function user(Request $request)
	{
		$services = $this->gatherServices($request);
		$group = "gfwlist";
		foreach ($services as $service) {
			$salt = uniqid("$5$", true);
			$hash = crypt($service->password, $salt);
			echo "{$service->username}:{$group}:{$hash}\n";
		}

	}
}
