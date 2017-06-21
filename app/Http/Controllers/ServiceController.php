<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
	//

	public $user;
	public $request;

	public function __construct(Request $r)
	{
		$user = $r->user();
		$request = $r;
	}

	public function listAllService()
	{
		return dataFormatter($this->user->services()->all());
	}

	public function showIndividualService()
	{
		return dataFormatter($this->request->currentServiceModel);
	}
}
