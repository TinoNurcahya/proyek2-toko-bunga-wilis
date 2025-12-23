<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class IotDashboardController extends Controller
{
    public function index()
    {
        $latest = DB::table('sensor_data')
            ->orderByDesc('created_at')
            ->first();

        return view('admin.iot', compact('latest'));
    }

    public function data(Request $request)
    {
        $hours = (int) $request->get('hours', 24);
        $from = Carbon::now()->subHours($hours);

        $data = DB::table('sensor_data')
            ->where('created_at', '>=', $from)
            ->orderBy('created_at', 'asc')
            ->get(['suhu', 'kelembaban', 'soil', 'cahaya', 'created_at']);

        return response()->json($data);
    }

    public function pump(Request $request)
    {
        $request->validate([
            'action'   => 'required|in:ON,OFF',
            'duration' => 'nullable|integer|min:1|max:60'
        ]);

        $payload = json_encode([
            'pump'     => $request->action,
            'duration' => (int)($request->duration ?? 3), // CONVERT TO INTEGER
            'source'   => 'laravel',
            'time'     => now()->toDateTimeString()
        ]);


        try {
            $server   = 'broker.hivemq.com';
            $port     = 1883;
            $clientId = 'laravel-pump-' . uniqid();

            $mqtt = new MqttClient($server, $port, $clientId);

            $settings = (new ConnectionSettings)
                ->setKeepAliveInterval(60)
                ->setConnectTimeout(5)
                ->setUseTls(false);

            $mqtt->connect($settings, true);
            $mqtt->publish('iot/tanaman/control', $payload, 0);
            $mqtt->disconnect();

            return response()->json([
                'status'  => 'success',
                'message' => 'Perintah pompa terkirim',
                'data'    => json_decode($payload, true),
                'debug'   => [
                    'payload_sent' => $payload,
                    'duration_type' => gettype($request->duration)
                ]
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'MQTT gagal: ' . $e->getMessage()
            ], 500);
        }
    }
}
