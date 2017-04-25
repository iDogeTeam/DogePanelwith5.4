<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NodeGroup extends Model
{
	// Properties

	protected $dateFormat = 'U';
	/**
	 * Table Name
	 *
	 * @var string
	 */
	protected $table = 'node_groups';


	// Relationship

	/**
	 * Link to Services
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function services()
	{
		return $this->hasMany(UserService::class, 'group_id', 'id');
	}

	/**
	 * Link to related nodes
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function nodes()
	{
		return $this->hasMany(Node::class, 'group_id', 'id');
	}
}
