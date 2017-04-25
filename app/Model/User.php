<?php

namespace App;

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
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];


	// Relationship

	/**
	 * Link to a group
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function userGroup()
	{
		return $this->belongsTo(UserGroup::class, 'user_id', 'id');
	}

	/**
	 * Link to user change log
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function userChangeLog()
	{
		return $this->hasMany(UserChangeLog::class, 'user_id', 'id');
	}

	/**
	 * Link to user service
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function userServices()
	{
		return $this->hasMany(UserService::class, 'user_id', 'id');
	}

	/**
	 * Link to related Items
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function items()
	{
		return $this->belongsToMany(Item::class)->using(ItemUser::class);
	}

	// End of Relationship


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
		if ($trafficChangeLog = $this->trafficChangeLogs()->where('type', 'checkin')->first()->get()) {
			return $trafficChangeLog->created_at;
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

	/**
	 * Update user's specific service password
	 *
	 * @param $id
	 * @param $password
	 * @return bool
	 */
	public function updateServicePassword($id, $password)
	{
		if ($service = $this->userServices()->Id()) {
			$service->password = $password;
			$service->save();

			return true;
		}

		return false;
	}

	/**
	 * Update user's specific service method
	 *
	 * @param $id
	 * @param $method
	 * @return bool
	 */
	public function updateServiceMethod($id, $method)
	{
		if ($service = $this->userServices()->Id()) {
			$service->method = $method;
			$service->save();

			return true;
		}

		return false;
	}

	// Judgement

	/**
	 * Identify user's role
	 *
	 * @return bool
	 */
	public function isAdmin()
	{
		return $this->attributes['role'] == 'admin' ? true : false;
	}

	public function isAbleToCheckIn()
	{
		if ($last = $this->lastCheckInTime()) {
			$hour = env('CHECK_IN_TIME', 22);
			if (time() - strtotime($last) >= $hour * 3600) {
				return true;
			}

			return false;
		} else {
			return true; // First time Register
		}
	}

	// @TODO 未完成
	public function trafficUsagePercent()
	{
		$total = $this->attributes['u'] + $this->attributes['d'];
		$transferEnable = $this->attributes['transfer_enable'];
		if ($transferEnable == 0) {
			return 0;
		}
		$percent = $total / $transferEnable;
		$percent = round($percent, 2);
		$percent = $percent * 100;

		return $percent;
	}

	public function enableTraffic()
	{
		$transfer_enable = $this->attributes['transfer_enable'];

		return Tools::flowAutoShow($transfer_enable);
	}

	public function enableTrafficInGB()
	{
		$transfer_enable = $this->attributes['transfer_enable'];

		return Tools::flowToGB($transfer_enable);
	}

	public function usedTraffic()
	{
		$total = $this->attributes['u'] + $this->attributes['d'];

		return Tools::flowAutoShow($total);
	}

	public function unusedTraffic()
	{
		$total = $this->attributes['u'] + $this->attributes['d'];
		$transfer_enable = $this->attributes['transfer_enable'];

		return Tools::flowAutoShow($transfer_enable - $total);
	}

	/*
	 * @param traffic 单位 MB
	 */
	public function addTraffic($traffic)
	{
	}

	public function inviteCodes()
	{
		$uid = $this->attributes['id'];

		return InviteCode::where('user_id', $uid)->get();
	}
}
