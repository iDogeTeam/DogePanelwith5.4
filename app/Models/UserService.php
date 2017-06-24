<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
	// Properties

	protected $dateFormat = 'U';

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
	public function trafficLogs()
	{
		return $this->hasMany(TrafficLog::class, 'service_id', 'id');
	}

	/**
	 * Link to a nodeGroup
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function nodeGroup()
	{
		return $this->belongsTo(NodeGroup::class, 'group_id', 'id');
	}

	/**
	 * Link to specific User
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	// Attribute

	public function getStatusAttribute($status)
	{
		if ($this->user()->getRelated()->traffic_enable !== '1') {
			return false;
		}

		return $status;
	}

	// Query

	public function scopeId($query, $Id)
	{
		return $query->where('id', $Id)->firstOrFail();
	}

	// Action

	public function isUserHasService($id)
	{
		return $this->user_id == $id;
	}

	public function updateServiceInformation($data)
	{
		if ($this->update($data->all())) {
			return true;
		}

		return false;
	}
}
