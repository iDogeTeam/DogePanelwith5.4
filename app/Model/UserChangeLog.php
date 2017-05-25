<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChangeLog extends Model
{
	// Properties

	protected $dateFormat = 'U';

	/**
	 * Table Name
	 *
	 * @var string
	 */
	protected $table = 'user_change_logs';

	// Relationship

	public function user()
	{
		return $this->belongsTo(User::class);
	}

}
