<?php

namespace App\Listeners\Subscriber;


class UserNotificationSubscriber
{

	public function notifyViaTelegram()
	{

	}

	public function subscribe($events)
	{
		$events->listen(
			'App\Events\UserDoesNotHaveEnoughCoins',
			'App\Listeners\UserNotificationSubscriber@notifyViaTelegram'
		);

	}
}