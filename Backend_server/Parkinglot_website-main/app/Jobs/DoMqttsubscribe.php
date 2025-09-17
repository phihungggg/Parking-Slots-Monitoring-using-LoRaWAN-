<?php

namespace App\Jobs;
use Carbon\Carbon;
use App\Events\Transport_data;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use PhpMqtt\Client\Facades\MQTT;
use App\Models\Slot;
use App\Models\Slotoccupied;
use Illuminate\Support\Facades\DB;
use App\Enums\Slots;
use App\Events\Send_parking_history;

class DoMqttsubscribe implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void //invoked when the job is processed by the queue
    {
        echo "Xin chao";

        $mqtt = Mqtt::connection();

        if ($mqtt->isConnected()) {
           // $mqtt->publish('something/st', 'test', 0);

            // Subscribe to the topic
            $mqtt->subscribe('v3/parkinglot-greenstream@ttn/devices/slot-1/up',
                function (string $topic, string $message) use ($mqtt) {
                   
                  
                  //  echo sprintf("\n \n \n Received QoS level 0 message on topic [%s]: %s", $topic, $message);


                    $data = json_decode($message, true);
                
                    // Check if decoding was successful and retrieve the decoded payload
                    if (isset($data['uplink_message']['decoded_payload']['Payload'])) {
                        $decodedPayload = $data['uplink_message']['decoded_payload']['Payload'];
                        echo sprintf(" \n \n \n Decoded payload: %s", $decodedPayload);

                        $lastCharacter = substr($decodedPayload, -1);
                        $sixthCharacter = substr($decodedPayload, 5, 1);
                        $lastNumber = (int)$lastCharacter;
                        $sixthNumber = (int)$sixthCharacter;
                        $slot = Slot::where('slot_id', 0)->first();
                        $slot4 = Slot::where('slot_id',3)->first();
DB::beginTransaction();
try {
    if($slot->slot_status!=$sixthNumber)
    {
        if($sixthNumber==0)
        {
            $now = Carbon::now()->format('Y-m-d H:i:s');
        Slotoccupied::create([
            'slot_id' => $slot->slot_id,
            'Come_at' => $now,
        ]);
        echo(" come at  \n");
        broadcast( new Send_parking_history($slot->slot_id,  $now,null));
        }else if($sixthNumber===1&&$slot->slot_status===0)
        {
            $get_slot_null_leave_time= Slotoccupied::where('Leave_at',null)->where('slot_id', $slot->slot_id)->first();

            $get_slot_null_leave_time->Leave_at=Carbon::now()->format('Y-m-d H:i:s');

            $get_slot_null_leave_time->save();
            echo (" leave at \n");
            broadcast( new Send_parking_history($get_slot_null_leave_time->slot_id,  $get_slot_null_leave_time->Come_at,$get_slot_null_leave_time->Leave_at));
        }
        


    $slot->slot_status = $sixthNumber;
    $slot->save();
    broadcast( new Transport_data(Slots::SLOT1,$sixthNumber));
    }


    ///broadcast( new Transport_data());
    if ( $slot4->slot_status != $lastNumber){
        if($lastNumber==0)
        {
            $now = Carbon::now()->format('Y-m-d H:i:s');
        Slotoccupied::create([
            'slot_id' => $slot4->slot_id,
            'Come_at' => Carbon::now(),
        ]);
        echo ( " come at \n");
        broadcast( new Send_parking_history($slot4->slot_id,  $now,null));
        }else if($lastNumber===1&&$slot4->slot_status===0)
        {
            $get_slot_null_leave_time= Slotoccupied::where('Leave_at',null)->where('slot_id', $slot4->slot_id)->first();

            $get_slot_null_leave_time->Leave_at=Carbon::now()->format('Y-m-d H:i:s');

    $get_slot_null_leave_time->save();
    echo (" leave at \n");
    broadcast( new Send_parking_history($get_slot_null_leave_time->slot_id,  $get_slot_null_leave_time->Come_at,$get_slot_null_leave_time->Leave_at));
        }



    $slot4->slot_status = $lastNumber;
    $slot4->save();
    broadcast( new Transport_data(Slots::SLOT4,$lastNumber));
    }
    

   
    DB::commit();
} catch (\Exception $e) {
    DB::rollBack();
    echo "Failed to update slot status: " . $e->getMessage();
}

                        echo sprintf("\n something %d ",$lastNumber);
                    } else 
                        echo "No decoded payload found.";
                }, 0
            );




            $mqtt->subscribe('v3/parkinglot-greenstream@ttn/devices/slot-3/up',
            function (string $topic, string $message) use ($mqtt) {
               
              
              //  echo sprintf("\n \n \n Received QoS level 0 message on topic [%s]: %s", $topic, $message);


                $data = json_decode($message, true);
            
                // Check if decoding was successful and retrieve the decoded payload
                if (isset($data['uplink_message']['decoded_payload']['Payload'])) {
                    $decodedPayload = $data['uplink_message']['decoded_payload']['Payload'];
                    echo sprintf(" \n \n \n Decoded payload: %s", $decodedPayload);

                    $lastCharacter = substr($decodedPayload, -1);
                    $sixthCharacter = substr($decodedPayload, 5, 1);
                    $lastNumber = (int)$lastCharacter;
                    $sixthNumber = (int)$sixthCharacter;
                    $slot3 = Slot::where('slot_id', 2)->first();
                    $slot6 = Slot::where('slot_id', 5)->first();
                    
DB::beginTransaction();
try {
    if($slot3->slot_status!=$sixthNumber)
    { $a=null;
        if($sixthNumber==0)
        {
            $now = Carbon::now()->format('Y-m-d H:i:s');
        Slotoccupied::create([
            'slot_id' => $slot3->slot_id,
            'Come_at' => $now,
        ]);
        echo (" come at " );
        broadcast( new Send_parking_history($slot3->slot_id,  $now,null));
        echo ( " after broadcast come at ");
        }else if($sixthNumber===1&&$slot3->slot_status===0)
        {
            $get_slot_null_leave_time= Slotoccupied::where('Leave_at',null)->where('slot_id', $slot3->slot_id)->first();

            $get_slot_null_leave_time->Leave_at=Carbon::now()->format('Y-m-d H:i:s') ;
            
            $a=$get_slot_null_leave_time;
                 $get_slot_null_leave_time->save();
                 echo (" leave at " );
                 
                 broadcast( new Send_parking_history($get_slot_null_leave_time->slot_id,  $get_slot_null_leave_time->Come_at,$get_slot_null_leave_time->Leave_at));
                echo(" after broadcast leave at ");
                }

//broadcast( new Send_parking_history($a->slot_id,  $a->Come_at,$a->Leave_at));

$slot3->slot_status = $sixthNumber;
$slot3->save();

broadcast( new Transport_data(Slots::SLOT3,$sixthNumber));
}
//broadcast( new Transport_data());

if($slot6->slot_status != $lastNumber)
{   if($lastNumber==0)
    {   
        $now = Carbon::now()->format('Y-m-d H:i:s');
    Slotoccupied::create([
        'slot_id' => $slot6->slot_id,
        'Come_at' => $now,
    ]);
    echo (" come at  ");
    broadcast( new Send_parking_history($slot6->slot_id,  $now,null));
    echo (" after broadcast come at");
    }else if($lastNumber===1&&$slot6->slot_status===0)
    {
        $get_slot_null_leave_time= Slotoccupied::where('Leave_at',null)->where('slot_id', $slot6->slot_id)->first();

        $get_slot_null_leave_time->Leave_at=Carbon::now()->format('Y-m-d H:i:s');

$get_slot_null_leave_time->save();

echo (" leave at ");
broadcast( new Send_parking_history($get_slot_null_leave_time->slot_id,  $get_slot_null_leave_time->Come_at,$get_slot_null_leave_time->Leave_at));

echo ( " after broadcast leave at ");
    }



$slot6->slot_status = $lastNumber;
$slot6->save();
broadcast( new Transport_data(Slots::SLOT6,$lastNumber));
}
DB::commit();
} catch (\Exception $e) {
DB::rollBack();
echo "Failed to update slot status: " . $e->getMessage();
}

                    echo sprintf("\n something %d ",$lastNumber);
                } else 
                    echo "No decoded payload found.";
            }, 0
        );




        $mqtt->subscribe('v3/parkinglot-greenstream@ttn/devices/slot-2222/up',
        function (string $topic, string $message) use ($mqtt) {
           
          
          //  echo sprintf("\n \n \n Received QoS level 0 message on topic [%s]: %s", $topic, $message);


            $data = json_decode($message, true);
        
            // Check if decoding was successful and retrieve the decoded payload
            if (isset($data['uplink_message']['decoded_payload']['Payload'])) {
                $decodedPayload = $data['uplink_message']['decoded_payload']['Payload'];
                echo sprintf(" \n \n \n Decoded payload: %s", $decodedPayload);

                $lastCharacter = substr($decodedPayload, -1);
                $sixthCharacter = substr($decodedPayload, 5, 1);
                $lastNumber = (int)$lastCharacter;
                $sixthNumber = (int)$sixthCharacter;
                
                $slot2 = Slot::where('slot_id', 1)->first();
                $slot5 = Slot::where('slot_id', 4)->first();
                
DB::beginTransaction();
try {
    if($slot2->slot_status!=$sixthNumber)
    {
        if($sixthNumber==0)
        {
            $now = Carbon::now()->format('Y-m-d H:i:s');
        Slotoccupied::create([
            'slot_id' => $slot2->slot_id,
            'Come_at' => $now,
        ]);
        echo(" come at \n");
        broadcast( new Send_parking_history($slot2->slot_id,  $now,null));
        }else if($sixthNumber===1&&$slot2->slot_status===0)
        {
            $get_slot_null_leave_time= Slotoccupied::where('Leave_at',null)->where('slot_id', $slot2->slot_id)->first();

            $get_slot_null_leave_time->Leave_at=Carbon::now()->format('Y-m-d H:i:s');

    $get_slot_null_leave_time->save();
    echo (" leave at \n");
    broadcast( new Send_parking_history($get_slot_null_leave_time->slot_id,  $get_slot_null_leave_time->Come_at,$get_slot_null_leave_time->Leave_at));
        }


$slot2->slot_status = $sixthNumber;
$slot2->save();
broadcast( new Transport_data(Slots::SLOT2,$sixthNumber));}

//broadcast( new Transport_data());
if($slot5->slot_status != $lastNumber){
    if($lastNumber==0)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
    Slotoccupied::create([
        'slot_id' => $slot5->slot_id,
        'Come_at' => $now,
    ]);
    echo(" come at \n");
    broadcast( new Send_parking_history($slot5->slot_id,  $now,null));
    }else if($lastNumber===1&&$slot5->slot_status===0)
    {
        $get_slot_null_leave_time= Slotoccupied::where('Leave_at',null)->where('slot_id', $slot5->slot_id)->first();

        $get_slot_null_leave_time->Leave_at=Carbon::now()->format('Y-m-d H:i:s');

$get_slot_null_leave_time->save();
echo(" leave at \n");
broadcast( new Send_parking_history($get_slot_null_leave_time->slot_id,  $get_slot_null_leave_time->Come_at,$get_slot_null_leave_time->Leave_at));
    }


$slot5->slot_status = $lastNumber;
$slot5->save();
broadcast( new Transport_data(Slots::SLOT5,$lastNumber));}

DB::commit();
} catch (\Exception $e) {
DB::rollBack();
echo "Failed to update slot status: " . $e->getMessage();
}

                echo sprintf("\n something %d ",$lastNumber);
            } else 
                echo "No decoded payload found.";
        }, 0
    );


            // Run loop in a non-blocking way
         
            $mqtt->loop(true);
        } 
    }
}
