<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
class RegisterVehicle extends Controller
{
    public function show_vehicle_register()
    {
        // Fetch parking slots data from the database
      

        // Pass data to the view
        return view('register_vehicle');
    }


    public function store(Request $request)
    {
// Validate the incoming request data
$validated = $request->validate([
    'license_plate' => 'required|string|unique:vehicles,license_plate',
    'vehicle_type' => 'required|in:Car,Truck,Bus,Motorcycle',
    'owner_name' => 'required|string|max:255',
    'owner_identify_number' => 'required|string|max:255',
]);

// Create a new vehicle record in the database
$vehicle = Vehicle::create([
    'license_plate' => $validated['license_plate'],
    'vehicle_type' => $validated['vehicle_type'],
    'owner_name' => $validated['owner_name'],
    'owner_identify_number' => $validated['owner_identify_number'],
]);

// Optionally, redirect or return a response
return redirect()->route('vehicle.registration.success');  // You can create a success route to show a success message


    }
}
