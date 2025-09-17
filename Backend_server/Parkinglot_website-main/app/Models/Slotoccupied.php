<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slotoccupied extends Model
{
    use HasFactory;

    protected $table = 'slot_occupied';
    protected $fillable = [
        'slot_id',
        'Come_at',
        'Leave_at',
    ];


}
