<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/home';  // disabled

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name'     => 'required|max:255',
			'email'    => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
		]);
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request)
	{
		$this->validator($request->all())->validate();

		event(new Registered($user = $this->create($request->all(), $request->ip())));

		$this->guard()->login($user);

		return $this->registered($request, $user);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array $data
	 * @return User
	 */
	protected function create(array $data, $ipaddress)
	{
		return User::create([
			'name'        => $data['name'],
			'email'       => $data['email'],
			'password'    => bcrypt($data['password']),
			'register_ip' => $ipaddress,
		]);
	}

	public function showRegistrationForm()
	{
	}

	/**
	 * The user has been registered.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  mixed $user
	 * @return mixed
	 */
	protected function registered(Request $request, $user)
	{
		//
		return Response()->json(['status' => 'success']);
	}
}
