<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;


    protected $table = 'slots1'; // Ensure the correct table name
    protected $primaryKey = 'slot_id'; // Set the primary key to 'slot_id' if it's different from 'id'
    public $incrementing = false; // Set to true if 'slot_id' is auto-incrementing
    protected $keyType = 'int'; // Set to 'int' if 'slot_id' is an integer
}
