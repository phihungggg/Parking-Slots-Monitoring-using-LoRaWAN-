<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Enums\Slots;
class Transport_data implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public Slots $slot;
    public $data;
    /**
     * Create a new event instance.
     */
    //Slots $slot_id,$dataa
    public function __construct(Slots $slot_id,$dataa)
    {
        $this->slot = $slot_id;
        $this->data= $dataa;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {

        



        return [
            new Channel('transport_information'),
        ];
    }


    public function broadcastWith()
    {
        return [
            'slot' => $this->slot,
            'data' => $this->data,
        ];
    }
}
