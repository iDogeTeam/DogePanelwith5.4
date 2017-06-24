<?php

namespace App\Listeners\Subscriber;

use App\UserChangeLog;

class TopUpEventSubscriber
{

	public function addTopUpLog($event)
	{
		$user = $event->user;

		$log = new UserChangeLog;
		$log->source_type = $event->sourceType;
		$log->coin = $event->amount;
		$log->note = empty($event->note) ? NULL : $event->note;

		$user->changeLogs()->save($log);
	}


	public function subscribe($events)
	{
		$events->listen(
			'App\Events\UserCheckIn',
			'App\Listeners\TopUpEventSubscriber@addTopUpLog'
		);

	}
}