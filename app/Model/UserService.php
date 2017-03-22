<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
	//
	protected $table = 'ss_user_services';

	public function scopeId($query, $Id)
	{
		return $query->where('id', $Id)->firstOrFail();
	}
}
