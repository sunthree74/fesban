<?php

namespace App\Events;

use App\Klub;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GrupStop implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $grup;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Klub $klub)
    {
        $this->grup = $klub;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('grup-stop');
    }
}
