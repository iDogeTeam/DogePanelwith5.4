<?php

namespace App\Listeners;

use App\Events\RedeemCode;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DistributeGift
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
     * @param  RedeemCode  $event
     * @return void
     */
    public function handle(RedeemCode $event)
    {
        //
    }
}
