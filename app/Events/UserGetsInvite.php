<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;
use App\Item;

class UserGetsInvite
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $item;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Item $item)
    {
        $this->user = $user;
        $this->item = $item;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
