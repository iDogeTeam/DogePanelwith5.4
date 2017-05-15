<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    	return 'TOS goes here';
	}
}
