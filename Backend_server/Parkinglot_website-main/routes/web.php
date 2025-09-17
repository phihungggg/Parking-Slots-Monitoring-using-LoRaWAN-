<?php
use App\Events\Send_parking_history;
use Carbon\Carbon;
use App\Models\Slotoccupied;
use App\Events\Transport_data;
use Illuminate\Support\Facades\Route;
use App\Enums\Slots;
use App\Models\Slot;

use App\Http\Controllers\MapController;
use App\Http\Controllers\RegisterVehicle;
use App\Http\Controllers\Reservation_Controller;
use App\Http\Controllers\Show_parking_history;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\Slottt_occupies_admin;



Route::get('/testbroadcast1_1', function () {
   // broadcast( new Transport_data(Slots::SLOT1,1));

   DB::beginTransaction();
   try {
   $slot = Slot::where('slot_id', 0)->first();
    if( $slot->slot_status===0 && Slotoccupied::where('Leave_at',null)->where('slot_id', $slot->slot_id)->first()!=null)
    {
        $get_slot_null_leave_time= Slotoccupied::where('Leave_at',null)->where('slot_id', $slot->slot_id)->first();

            $get_slot_null_leave_time->Leave_at=Carbon::now()->format('Y-m-d H:i:s');

    $get_slot_null_leave_time->save();

        broadcast( new Send_parking_history($get_slot_null_leave_time->slot_id,  $get_slot_null_leave_time->Come_at,$get_slot_null_leave_time->Leave_at));
    
    }


  $slot->slot_status = 1;
   $slot->save();


   broadcast( new Transport_data(Slots::SLOT1,1));
   DB::commit();}
   
   catch (\Exception $e) {
     DB::rollBack();
     echo "Failed to update slot status: " . $e->getMessage();
 }
});

Route::get('/testbroadcast1_0', function () {
    // broadcast( new Transport_data(Slots::SLOT1,1));
    DB::beginTransaction();
    try {
    $slot = Slot::where('slot_id', 0)->first();

    if( $slot->slot_status===1 || $slot->slot_status===2 )
    { $now= Carbon::now()->format('Y-m-d H:i:s');
        Slotoccupied::create([
            'slot_id'=> $slot->slot_id,
            'Come_at' => $now,
        ]);

        broadcast( new Send_parking_history($slot->slot_id,  $now,null));
        
    }
   $slot->slot_status = 0;
    $slot->save();
    broadcast( new Transport_data(Slots::SLOT1,0));
    DB::commit();}
    catch (\Exception $e) {
      DB::rollBack();
      echo "Failed to update slot status: " . $e->getMessage();
  }
 });


Route::get('/testbroadcast2_1', function () {
    // broadcast( new Transport_data(Slots::SLOT1,1));
    DB::beginTransaction();
    try {
    $slot = Slot::where('slot_id', 1)->first();
    if( $slot->slot_status===0 && Slotoccupied::where('Leave_at',null)->where('slot_id', $slot->slot_id)->first()!=null)
    {
        $get_slot_null_leave_time= Slotoccupied::where('Leave_at',null)->where('slot_id', $slot->slot_id)->first();

            $get_slot_null_leave_time->Leave_at=Carbon::now()->format('Y-m-d H:i:s');

    $get_slot_null_leave_time->save();
    broadcast( new Send_parking_history($get_slot_null_leave_time->slot_id,  $get_slot_null_leave_time->Come_at,$get_slot_null_leave_time->Leave_at));
    }





   $slot->slot_status = 1;
    $slot->save();
 
 
    broadcast( new Transport_data(Slots::SLOT2,1));
    DB::commit();}
    
    catch (\Exception $e) {
      DB::rollBack();
      echo "Failed to update slot status: " . $e->getMessage();
  }
 });

 Route::get('/testbroadcast2_0', function () {
    // broadcast( new Transport_data(Slots::SLOT1,1));
    DB::beginTransaction();
    try {
    $slot = Slot::where('slot_id', 1)->first();

    if( $slot->slot_status===1 || $slot->slot_status===2 )
    {$now= Carbon::now()->format('Y-m-d H:i:s');
        Slotoccupied::create([
            'slot_id'=> $slot->slot_id,
            'Come_at' => $now,
        ]);

        broadcast( new Send_parking_history($slot->slot_id,  $now,null));
    }



   $slot->slot_status = 0;
    $slot->save();
 
 
    broadcast( new Transport_data(Slots::SLOT2,0));
    DB::commit();}
    
    catch (\Exception $e) {
      DB::rollBack();
      echo "Failed to update slot status: " . $e->getMessage();
  }
 });

 Route::get('/testbroadcast3_1', function () {
    // broadcast( new Transport_data(Slots::SLOT1,1));
    DB::beginTransaction();
    try {
    $slot = Slot::where('slot_id', 2)->first();
   $slot->slot_status = 1;
    $slot->save();
 
 
    broadcast( new Transport_data(Slots::SLOT3,1));
    DB::commit();}
    
    catch (\Exception $e) {
      DB::rollBack();
      echo "Failed to update slot status: " . $e->getMessage();
  }
 });

 Route::get('/testbroadcast3_0', function () {
    // broadcast( new Transport_data(Slots::SLOT1,1));
    DB::beginTransaction();
    try {
    $slot = Slot::where('slot_id', 2)->first();
   $slot->slot_status = 0;
    $slot->save();
 
 
    broadcast( new Transport_data(Slots::SLOT3,0));
    DB::commit();}
    
    catch (\Exception $e) {
      DB::rollBack();
      echo "Failed to update slot status: " . $e->getMessage();
  }
 });

Route::get('/slot_occupies',[Show_parking_history::class,'handleData'] )->middleware(Slottt_occupies_admin::class)->middleware(['auth', 'verified']);



 Route::post('/map', [Reservation_Controller::class, 'handleData']);


 Route::get('/map', [MapController::class, 'showMap'])->name('map')->middleware(['auth', 'verified']);

 Route::get('/registervehicle', [RegisterVehicle::class, 'show_vehicle_register'])->name('vehicle_register')->middleware(['auth', 'verified']);

Route::view('/', 'welcome')->name('welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('reservations', 'reservations')
    ->name('reservations')->middleware(['auth', 'verified']);



require __DIR__.'/auth.php';
require __DIR__.'/map_route.php';