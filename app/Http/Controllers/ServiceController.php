<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
	//

	public function __construct()
	{
	}

	public function listAllServices(Request $request)
	{
		return dataFormatter($request->user()->services()->get());
	}

	public function showIndividualService(Request $request)
	{
		return dataFormatter($request->currentServiceModel);
	}

	public function showIndividualServiceRecentTrafficLog(Request $request)
	{
		return dataFormatter($request->currentServiceModel->trafficLogs()->take(empty($request->num) ? 20 : $request->num)->get());
	}
}
