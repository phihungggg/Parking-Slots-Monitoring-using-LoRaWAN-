<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentReservation extends Model
{
    use HasFactory;
    protected $table = 'current_reservation';



    protected $fillable = [
        'user_id', 
        'slot_id', 
        'duration',
        'Expiration_Time',
    ];


}
