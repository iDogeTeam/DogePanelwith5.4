<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
	/**
	 * Table Name
	 *
	 * @var string
	 */
	protected $table = 'user_services';

	// Relationship

	/**
	 * Link to traffic log
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function trafficLog()
	{
		return $this->hasMany(TrafficLog::class);
	}

	/**
	 * Link to a nodeGroup
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function nodeGroup()
	{
		return $this->belongsTo(NodeGroup::class, 'group_id','id');
	}

	/**
	 * Link to specific User
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class,'user_id','id');
	}



	// Query

	public function scopeId($query, $Id)
	{
		return $query->where('id', $Id)->firstOrFail();
	}
}
