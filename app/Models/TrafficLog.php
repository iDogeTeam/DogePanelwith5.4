<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrafficLog extends Model
{
	// Properties

	protected $dateFormat = 'U';
	protected $table = 'traffic_logs';

	// Relationship

	public function service()
	{
		return $this->belongsTo(UserService::class, 'service_id', 'id');
	}

	/**
	 * User Addresses
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function ipAddress()
	{
		return $this->morphMany('App\IPAddress', 'source');
	}
}
