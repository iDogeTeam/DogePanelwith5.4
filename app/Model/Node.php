<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
	// Properties

	protected $dateFormat = 'U';
	// Relationships

	/**
	 * Link to nodeGroup
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function nodeGroup()
	{
		return $this->belongsTo(NodeGroup::class, 'group_id', 'id');
	}


	/**
	 * Link to node logs
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function nodeStatusLog()
	{
		return $this->hasMany(NodeStatus::class, 'node_id', 'id');
	}

	// Operations

	/**
	 * Get all Services belong to certain nodes
	 *
	 * @return mixed
	 */
	public function userService()
	{
		return $this->nodeGroup()->services();
	}
}
