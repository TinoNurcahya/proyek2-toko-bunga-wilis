<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\Exceptions\DataTransferException;
use Illuminate\Support\Facades\DB;


class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe data sensor tanaman via MQTT';

    public function handle()
    {
        $this->info('🟢 MQTT Listener started');

        while (true) {
            try {
                $host = env('MQTT_HOST', '127.0.0.1');
                $port = (int) env('MQTT_PORT', 1883);
                $clientId = env('MQTT_CLIENT_ID', 'laravel-tanaman');

                // The .env may contain the string 'null' — convert to PHP null
                $username = env('MQTT_USERNAME');
                $username = $username === 'null' ? null : $username;
                $password = env('MQTT_PASSWORD');
                $password = $password === 'null' ? null : $password;

                $mqtt = new MqttClient($host, $port, $clientId);

                $connectionSettings = (new ConnectionSettings())
                    ->setUsername($username)
                    ->setPassword($password)
                    ->useBlockingSocket(true);

                $mqtt->connect($connectionSettings, true);

                $mqtt->subscribe('iot/tanaman/data', function (string $topic, string $message) {
                    $this->info("📥 MQTT: $message");

                    $data = json_decode($message, true);
                    if (!$data) return;

                    DB::table('sensor_data')->insert([
                        'suhu'        => $data['suhu'] ?? 0,
                        'kelembaban'  => $data['kelembaban'] ?? 0,
                        'soil'        => $data['soil'] ?? 0,
                        'cahaya'      => $data['cahaya'] ?? 0,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                });

                $mqtt->loop(true); // blocking

            } catch (DataTransferException $e) {
                $this->error('⚠️ MQTT disconnected by broker, reconnecting...');
                sleep(3);
            } catch (\Throwable $e) {
                $this->error('❌ MQTT error: ' . $e->getMessage());
                sleep(5);
            }
        }
    }
}
