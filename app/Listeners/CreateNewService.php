<?php

namespace App\Listeners;

use App\Events\UserCreateNewService;
use App\NodeGroup;
use App\UserService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateNewService
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserCreateNewService $event
	 * @return void
	 */
	public function handle(UserCreateNewService $event)
	{
		//
		$service = new UserService();
		$service->type = $event->type;
		$service->password = randomString(8);
		switch ($event->type) {
			case 'shadowsocks':
				$group = NodeGroup::query()->where('type', 'shadowsocks')->inRandomOrder()->first();
				$service->group_id = $group->id;

				$used = $group->services()->map(function ($model) {
					return $model->port;
				})->flatten()->unique();
				$all = collect(range(10001, 19999));
				$port = $all->diff($used)->shuffle()->first();
				$service->port = $port;
				$service->method = $group->method;
				break;
			case 'anyconnect':
				$service->username = $event->user->email;
				break;
			default:
				break;
		}

		$event->user->services()->save($service);
	}
}
