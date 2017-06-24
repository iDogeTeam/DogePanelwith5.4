<?php

namespace App\Listeners\Subscriber;

use App\ItemLog;

class ItemsEventSubscriber
{

	public function addUsedItemLog($event)
	{
		$user = $event->user;
		$item = $event->item;

		$log = new ItemLog();
		$log->user_id = $user->id;
		$log->item_id = $item->id;
		$log->action = 'used';

		$log->save();
	}


	public function subscribe($events)
	{
		$events->listen(
			'App\Events\UserGetsInvite',
			'App\Listeners\ItemsEventSubscriber@addUsedItemLog'
		);

	}
}