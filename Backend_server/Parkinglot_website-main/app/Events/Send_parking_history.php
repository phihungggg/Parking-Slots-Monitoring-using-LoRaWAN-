<?php

namespace App\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Send_parking_history implements ShouldBroadcastNow
{ 
    use Dispatchable, InteractsWithSockets, SerializesModels;



    public $slot_id;
    public $Come_at;
    public $Leave_at;
    /**
     * Create a new event instance.
     */
    public function __construct( $slot_idd, $come_att, $leave_att  )
    {
        $this->slot_id =$slot_idd;
        $this->Come_at=$come_att;
        $this->Leave_at= $leave_att;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('Admin.'.Auth::id() ),
        ];
    }


    public function broadcastWith()
    {
        return [
            'slot_id' => $this->slot_id,
            'Come_at' => $this->Come_at,
            'Leave_at' =>$this->Leave_at,
        ];
    }
}
