<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot; // Adjust model name/path based on your setup

class MapController extends Controller
{
    public function showMap()
    {
        // Fetch parking slots data from the database
        $slots = Slot::select('slot_id', 'slot_status')->get();

        // Pass data to the view
        return view('map', ['slots' => $slots]);
    }
}
