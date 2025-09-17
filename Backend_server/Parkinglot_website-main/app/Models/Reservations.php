<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;


    protected $table = 'reservations1';



    protected $fillable = [
        'Slot_id', 
        'user_id', 
        'Reservation_time',
        'Expiration_Time',
    ];

}
