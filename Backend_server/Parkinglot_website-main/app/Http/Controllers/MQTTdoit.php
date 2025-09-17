<?php

namespace App\Http\Controllers;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Jobs\DoMqttsubscribe;
use App\Jobs\Delete_Current_Reservations;
class MQTTdoit extends Controller
{
    public $data;
    public function dosomething()
    {
        //Delete_Current_Reservations::dispatch();
        

        
        
       

    }

}
