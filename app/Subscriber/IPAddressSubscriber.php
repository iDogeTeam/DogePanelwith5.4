<?php

namespace App\Subscriber;

use App\IPAddress;

class IPAddressSubscriber
{

	public function LogIPAddress($event)
	{
		$ipAddress = new IPAddress;
		$ipAddress->source_id = $event->id;
		$ipAddress->source_type = $event->type;
		$ipAddress->description = $event->description;
		$ipAddress->ip_address = $event->ip_address;
		$ipAddress->saveOrFail();
	}


	public function subscribe($events)
	{
		$events->listen(
			'App\Events\LogIPAddress',
			'App\Subscriber\IPAddressSubscriber@LogIPAddress'
		);

	}
}