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

	public function parseShadowsocksRelatedUsers($token)
	{
		$services = $this->nodeReposity->getServices('token',$token)->map(function ($service) {
				if ($service->type === 'shadowsocks') {
					
					return $service;
				}
			});
	}

}