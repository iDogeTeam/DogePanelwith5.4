<?php

namespace App\Services;

use App\Repository\NodeRepository;

class NodeService
{

	protected $nodeReposity;

	public function __construct(NodeRepository $nodeRepository)
	{
		$this->nodeReposity = $nodeRepository;
	}

	public function parseShadowsocksRelatedUsers($node)
	{
		$services = $node->map(function ($service) {
				if ($service->type === 'shadowsocks') {

					return $service;
				}
			});
	}

}