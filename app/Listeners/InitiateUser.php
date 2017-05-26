<?php

namespace App\Listeners;

use App\Events\UserGetsInvite;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class InitiateUser
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
     * @param  VerifyUser  $event
     * @return void
     */
    public function handle(UserGetsInvite $event)
    {
        //
	    $user = $event->user;

	    $user->active_time = time();
	    $user->ref_by = $event->item->user_id;
	    $user->status = 'enable';

	    $user->saveOrFail();
    }
}
