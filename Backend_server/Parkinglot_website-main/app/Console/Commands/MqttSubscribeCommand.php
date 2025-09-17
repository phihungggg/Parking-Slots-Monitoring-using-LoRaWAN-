<?php

namespace App\Console\Commands;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Console\Command;

class MqttSubscribeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {   echo sprintf(" xin chao ");
        $mqtt = MQTT::connection();

        if ($mqtt->isConnected()) {
            $mqtt->subscribe('v3/parkinglot-greenstream@ttn/devices/slot-1/up', function (string $topic, string $message) {
                echo sprintf("Received message on topic [%s]: %s\n", $topic, $message);
            }, 1);

            // Keep the MQTT client loop running indefinitely
            $mqtt->loop(true);
        } else {
            $this->error('MQTT connection failed');
        }
    }
}
