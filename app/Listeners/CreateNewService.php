<?php

namespace App\Listeners;

use App\Events\UserCreateNewService;
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
     * @param  UserCreateNewService  $event
     * @return void
     */
    public function handle(UserCreateNewService $event)
    {
        //
	    $service = new UserService();

	    $event->user->services()->save();
    }
}
