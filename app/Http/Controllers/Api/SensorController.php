<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sensor_data;

class SensorController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data dari ESP32
        $request->validate([
            'temperature' => 'required',
            'flame' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        // Simpan suhu
        Sensor_data::create([
            'device_id' => 'ESP32_FOREST_01',
            'sensor_name' => 'temperature',
            'value' => $request->temperature
        ]);

        // Simpan status api
        Sensor_data::create([
            'device_id' => 'ESP32_FOREST_01',
            'sensor_name' => 'flame',
            'value' => $request->flame
        ]);

        // Simpan latitude
        Sensor_data::create([
            'device_id' => 'ESP32_FOREST_01',
            'sensor_name' => 'latitude',
            'value' => $request->latitude
        ]);

        // Simpan longitude
        Sensor_data::create([
            'device_id' => 'ESP32_FOREST_01',
            'sensor_name' => 'longitude',
            'value' => $request->longitude
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data sensor berhasil disimpan'
        ], 201);
    }
}