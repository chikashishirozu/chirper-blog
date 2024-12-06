<?php

namespace App\Events;

use App\Models\Chirp;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChirpUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chirp;

    /**
     * Create a new event instance.
     *
     * @param Chirp $chirp
     * @return void
     */
    public function __construct(Chirp $chirp)
    {
        $this->chirp = $chirp;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chirps.' . $this->chirp->id),
        ];
    }
}

