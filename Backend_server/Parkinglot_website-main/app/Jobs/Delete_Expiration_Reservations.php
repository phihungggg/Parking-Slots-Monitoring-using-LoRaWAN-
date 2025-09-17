<?php

namespace App\Jobs;
use App\Models\Slot;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\CurrentReservation;
use App\Events\Transport_data;
use App\Enums\Slots;
use Illuminate\Support\Facades\DB;


class Delete_Expiration_Reservations implements ShouldQueue
{
    use Queueable;
    protected $Current_user_id;
    protected $slot_id;
    /**
     * Create a new job instance.
     */
    public function __construct($reservation_id,$slot)
    {
       $this->Current_user_id= $reservation_id;
       $this->slot_id = $slot;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        echo(" deleted expiration reservation");
        //CurrentReservation::find($this->Current_user_id)->delete();
        $deleted= CurrentReservation::where('user_id',$this->Current_user_id)->delete();

        if (Slot::where('slot_status',2 )->where('slot_id',$this->slot_id)->first()!=null)
        {
            $slot = Slot::where('slot_id', $this->slot_id)->first();
            DB::beginTransaction();
            try{   $slot->slot_status = 1;
                $slot->save();
                DB::commit();

                switch($this->slot_id)
                {
                    case 0:
                        broadcast( new Transport_data(Slots::SLOT1,1));
                        break;
                    case 1:
                        broadcast( new Transport_data(Slots::SLOT2,1));
                        break;
                    case 2:
                        broadcast( new Transport_data(Slots::SLOT3,1));
                        break;
                    case 3:
                        broadcast( new Transport_data(Slots::SLOT4,1));
                        break;
                    case 4:
                        broadcast( new Transport_data(Slots::SLOT5,1));
                        break;
                    case 5:
                        broadcast( new Transport_data(Slots::SLOT6,1));
                        break;

                }

            }
            catch(\Exception $e){
                DB::rollBack();


            }
        }
    }
}
