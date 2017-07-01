<?php

namespace App;

use App\UserLevel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	// Properties

	protected $dateFormat = 'U';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'register_ip',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token', 'register_ip', 'note',
	];


	// Relationship

	/**
	 * Link to a group
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function group()
	{
		return $this->belongsTo(UserGroup::class, 'user_id', 'id');
	}

	/**
	 * Link to user change log
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function changeLogs()
	{
		return $this->hasMany(UserChangeLog::class, 'user_id', 'id');
	}

	/**
	 * Link to user service
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function services()
	{
		return $this->hasMany(UserService::class, 'user_id', 'id');
	}


	public function items()
	{
		return $this->hasMany(Item::class);
	}

	public function itemsLog()
	{
		return $this->hasMany(ItemLog::class);
	}
	// End of Relationship


	// Attribute
	public function getTrafficEnableAttribute($status)
	{
		if ($this->coins < $this->quota) {
			return false;
		}

		return $status;
	}

	/**
	 * admin if User's id is 1
	 *
	 * @param $role
	 * @return string
	 */
	public function getRoleAttribute($role)
	{
		if ($this->id == 1) return 'admin';

		return $role;
	}

	public function getLevelAttribute()
	{
		return UserLevel::where('amount', '<', $this->exp)->first()->level;
	}

	// User information

	/**
	 * get Avatar from Gravatar
	 *
	 * @return string
	 */
	public function getGravatarAttribute()
	{
		$hash = md5(strtolower(trim($this->attributes['email'])));

		return "https://secure.gravatar.com/avatar/$hash";
	}

	/**
	 * The last time that user uses the service @TODO
	 *
	 * @return \Illuminate\Contracts\Translation\Translator|string
	 */
	public function lastUsedTime()
	{
		if ($usedTrafficLog = $this->userServices()) {
			return $usedTrafficLog->time;
		}

		return __('general.unused');
	}

	/**
	 * The last time that user checks in
	 *
	 * @return \Illuminate\Contracts\Translation\Translator|string
	 */
	public function lastCheckInTime()
	{
		if ($ChangeLog = $this->changeLogs()->where('source_type', 'CheckIn')->first()) {
			return $ChangeLog->created_at;
		}

		return __('general.not_check_in_yet');
	}

	// Operation

	/**
	 * Update User's panel password
	 *
	 * @param $password
	 * @return bool
	 */
	public function updatePassword($password)
	{
		$this->password = bcrypt($password);
		$this->save();

		return true;
	}

	public function listAllServiceID()
	{
		return $this->services()->map(function ($service) {
			return $service->id;
		})->flatten()->toArray();
	}

	public function getServiceNumberByType($type)
	{
		return $this->services()->where('type', $type)->count();
	}

	public function listAllNodeGroupID()
	{
		return $this->services()->map(function ($service) {
			$service->nodeGroup()->first()->id;  // It used to be belonging relationship, but first method keep things smoothly..
		});
	}

	// Judgement (boolean)


	/**
	 * Identify user's role
	 *
	 * @return bool
	 */
	public function isAdmin()
	{
		return $this->attributes['role'] == 'admin' ? true : false;
	}

	/**
	 * Checkin Checker
	 *
	 * @return bool
	 */
	public function isAbleToCheckIn()
	{
		if ($last = $this->lastCheckInTime()) {
			$hour = env('CHECK_IN_TIME', 22);
			if (time() - strtotime($last) >= $hour * 3600) {
				return true;
			}

			return false;
		} else {
			return true; // Register
		}
	}

	public function isAbleToCreateNewService($type)
	{
		if (UserLevel::where('amount', '<', $this->exp)->first()->$type > $this->getServiceNumberByType($type)) return true;

		return false;
	}
}
