<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HourTrafficLog extends Model
{
	// Properties

	protected $dateFormat = 'U';

	protected $table = 'traffic_log_hour';
}
