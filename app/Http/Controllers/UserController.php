<?php

namespace App\Http\Controllers;

use App\Events\UserCheckIn;
use Illuminate\Http\Request;

class UserController extends Controller
{
	//
	public function __construct()
	{
	}

	public function showIndividual(Request $request)
	{
		return dataformatter($request->user());
	}

	public function doUserCheckIn(Request $request)
	{
		if ($request->user()->isAbleToCheckIn()) {
			$range = range(env('CHECK_IN_COIN_MAX', 1000), env('CHECK_IN_COIN_MIN', 100));
			shuffle($range);
			event(new UserCheckIn($request->user(), $range[0]));

			return dataFormatter(['amount' => $range[0]]);
		} else {
			return formatter(413, __('user.user_have_already_checked_in'), ['time' => $request->user()->lastCheckInTime()->timestamp]);
		}

	}

}
