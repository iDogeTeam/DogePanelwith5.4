<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Properties

	protected $dateFormat = 'U';

	// Relationship

	public function itemLog(){
		return $this->hasMany(ItemLog::class);
	}
}
