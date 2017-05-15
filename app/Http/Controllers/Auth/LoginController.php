<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/'; // disabled

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'logout']);
	}

	/*	public function showLoginForm()
		{
		}*/


	/**
	 * The user has been authenticated.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  mixed $user
	 * @return mixed
	 */
	protected function authenticated(Request $request, $user)
	{
		//
		return Response()->json(['code' => 200, 'status' => 'success']);
	}

	/**
	 * Get the failed login response instance.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function sendFailedLoginResponse()
	{
		return response()->json(['status' => trans('auth.failed')], 422);
	}

}
