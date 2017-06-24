<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NodeController extends Controller
{
	//
	public function __construct()
	{
	}

	public function listAllNodesWithinAService(Request $request)
	{
		return dataFormatter($request->currentServiceModel->nodegroup()->first()->nodes()->get());
	}

	public function showIndividualNode(Request $request)
	{
		return dataFormatter($request->currentNodeModel);
	}

	public function showIndividualNodeTrafficWithinAService(Request $request)
	{
		return dataFormatter($request->currentNodeModel->trafficLogs()->where('service_id', $request->currentServiceModel->id)->take(empty($request->num) ? 20 : $request->num)->get());
	}

}
