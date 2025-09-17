<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slotoccupied;
class Show_parking_history extends Controller
{
    public function handleData()
    {


        $slot_occupied = Slotoccupied::all();
        return view('slot_occupies', [ 'slot_occupied' => $slot_occupied        ]);
    }
}
