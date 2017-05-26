<?php

namespace App\Listeners;

use App\Events\CreateNewService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetUpService
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
     * @param  CreateNewService  $event
     * @return void
     */
    public function handle(CreateNewService $event)
    {
        //
    }
}
