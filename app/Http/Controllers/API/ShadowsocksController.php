<?php

namespace App\Http\Controllers\API;

use App\Events\LogIPAddress;
use App\TrafficLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShadowsocksController extends Controller
{
	//

	public function __construct()
	{
	}

	protected function gatherServices(Request $request)
	{
		$services = $request->node->nodeGroup()->first()->services()->get();
		$services->transform(function ($service) use ($request) {
			$service->traffic = GBtoByte($service->rest / ($request->node->upload_price + $request->node->download_price));

			return $service;
		});

		return $services;
	}

	public function user(Request $request)
	{
		$services = $this->gatherServices($request);

		return Response()->json([
			"status"    => 200,
			"timestamp" => time(),
			"interval"  => 1,
			"data"      => $services,
		]);
	}

	public function traffic(Request $request)
	{
		$data = $request->data;
		$id = $request->node->id;
		$upload_price = $request->node->upload_price;
		$download_price = $request->node->download_proce;
		$error = [];

		foreach ($data as $traffic) {
			$log = new TrafficLog();
			$log->node_id = $id;
			$log->service_id = $traffic['service_id'];
			$log->upload = $traffic['upload'];
			$log->download = $traffic['download'];
			$log->upload_price = $upload_price;
			$log->download_price = $download_price;
			if (!$log->save()) {
				$error[] = $traffic['service_id'];
			}

			foreach ($traffic['ip_addresses'] as $ipAddress) {
				event(new LogIPAddress('traffic', $log->id, $ipAddress));
			}

		}

		if (!empty($error)) {
			return response()->json([
				"status"      => 400,
				"timestamp"   => time(),
				"service_ids" => $error,
			]);
		}

		return Response()->json([
			"status"    => 200,
			"timestamp" => time(),
			"command"   => '',
			"data"      => $this->gatherServices($request),
		]);
	}
}
