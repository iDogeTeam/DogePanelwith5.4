<?php

namespace App\Repository;

use App\Node;

class NodeRepository
{
	protected $node;

	public function __construct(Node $node)
	{
		$this->node = $node;
	}

	/**
	 * Get all Services belong to a certain node
	 *
	 * @return mixed
	 */
	public function getServices($type, $input)
	{
		return $this->node->where($type, $input)->firstOrFail()->nodeGroup()->services();
	}
}