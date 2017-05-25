<?php

namespace App\Listeners;

use App\Events\UserCheckIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCheckInCoins
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
     * @param  UserCheckIn  $event
     * @return void
     */
    public function handle(UserCheckIn $event)
    {
        //
	    $event->user->coin += $event->amount;
	    $event->user->saveOrFail();
    }
}
