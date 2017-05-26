<?php

namespace App\Http\Controllers;

use App\Events\UserGetsInvite;
use Illuminate\Http\Request;
use App\Config;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		// @huihuimoe add what you need to init the VUE @ blade
		return view('home');
	}

	public function showTos()
	{
		if (empty($value = Config::where('key', 'TOS')->first())) {
			return formatter(404);
		} else {
			return formatter(200, ['content' => $value->value]);
		}
	}

	public function doVerification(Request $request)
	{
		if ($request->user()->status !== 'pending') {
			return formatter('413',['content' => __('general.user_has_already_verified')]);
		}

		if ($request->item->type !== 'inviteCode'){
			return formatter('413',['content' => __('code.wrong_code_type')]);
		}

		event(new UserGetsInvite($request->user(),$request->item));

		return formatter(200);
	}
}
