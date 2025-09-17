<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Events\Transport_data;
use App\Events\Send_reservation_notification;
use Illuminate\Http\Request;
use App\Models\Slot; 
use App\Models\CurrentReservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservations;
use App\Enums\Slots;
use App\Jobs\Delete_Expiration_Reservations;


use Label84\HoursHelper\HoursHelper;
class Reservation_Controller extends Controller
{
    //
public function handleData(Request $request)
{
    $Reserved=true;
$doeschange=false;
$isReserved_by_others=true;
    $reservation = $request->input('reservation');
    $slot = $request->input('slot'); 

    $slots = Slot::select('slot_id', 'slot_status')->get(); // get from index 0 to index 5 
    



    $getslot= $slots->get($slot);

  if(   CurrentReservation::withoutGlobalScopes()->where('user_id', Auth::id())->first() === null )//kiem tra xem user hien tai da dat cho nao chua
  {
    $Reserved=false;

 if ($getslot->slot_status==1) 
    
    {               $isReserved_by_others=false;
                    
                    $doeschange=true;
                $duration = round((60*floatval($request->input('duration'))));// string->float->int
                Log::info('Duration: ' . $duration);
                $expirationTime = Carbon::now()->addMinutes($duration);
                Log::info('Current Time: ' . Carbon::now()->toDateTimeString());

                Reservations::create(
                    [
                        'Slot_id'=> $getslot->slot_id ,
                        'user_id'=>Auth::id(),  
                        'Expiration_Time'=>$expirationTime,
                    ]
                    );
                    CurrentReservation::create(
                        [

                            'user_id'=>Auth::id(),
                            'slot_id'=>$getslot->slot_id,
                            'duration'=>$duration,
                            'Expiration_Time'=>$expirationTime,
                        ]
                    );
                    Delete_Expiration_Reservations::dispatch(Auth::id(),$getslot->slot_id)->delay(now()->addMinutes($duration));
                        DB::beginTransaction();
                        try{
                        $getslot->slot_status=2;
                        $getslot->save();
                        DB::commit();
                        switch($getslot->slot_id)
                        {
                            case 0:
                                broadcast( new Transport_data(Slots::SLOT1,2));
                                break;
                            case 1:
                                broadcast( new Transport_data(Slots::SLOT2,2));
                                break; 
                            case 2:
                                broadcast( new Transport_data(Slots::SLOT3,2));
                                break;    
                            case 3:
                                broadcast( new Transport_data(Slots::SLOT4,2));
                                break;  
                                
                            case 4:
                                broadcast( new Transport_data(Slots::SLOT5,2));
                                break;
                                    
                            case 5:
                                broadcast( new Transport_data(Slots::SLOT6,2));
                                break;  
                        }
                    }
                catch (\Exception $e) {
                    DB::rollBack(); // Rollback nếu có lỗi
                    throw $e; // Ném lại lỗi
                }
}
else if($getslot->slot_status==0) {
    //Log::info('Co gi do khong on roi' );
    $isReserved_by_others=false;
}
}
 
 // broadcast( new Send_reservation_notification($getslot->slot_id,$getslot->slot_status));

return response()->json([

    'slot' => $slot,
    'status'=> $getslot->slot_status,
    //'doeschange'=> $doeschange,
    'isReserved'=> $Reserved,
    'isReservedbyOther'=>$isReserved_by_others,
]);


}


}
