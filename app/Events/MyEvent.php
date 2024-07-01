<?php

namespace App\Events;

use App\Models\Pixel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Pixel $pixel;

    public function __construct($pixel)
    {
        $this->pixel = $pixel;
    }

    public function broadcastOn()
    {
        return ['my-channel'];
    }

    public function broadcastToEveryone()
    {
        return ['x' => $this->pixel->x
            ,'y' => $this->pixel->y
            ,'color' => $this->pixel->color
        ];
    }

}
