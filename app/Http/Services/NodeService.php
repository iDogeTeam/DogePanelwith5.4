<?php

namespace App\Services;

use App\Node;

class NodeService
{

	public function __construct()
	{
	}

	public function parseShadowsocksRelatedServices($node)
	{
		return $services = $node->map(function ($service) {
			if ($service->type === 'shadowsocks') {
				$response['service_id'] = $service->id;
				$response['port'] = $service->port;
				$response['traffic'] = $service->traffic;
				$response['method'] = $service->method;
				$response['enable'] = $service->enable ? true : false;
				return $response;
			}
		});
	}

}