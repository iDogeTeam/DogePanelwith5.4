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
		$this->belongsTo(UserService::class, 'service_id', 'id');
	}
}
