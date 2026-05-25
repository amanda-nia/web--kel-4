<?php

namespace App\Http\Controllers;

use App\Models\Sensor_data;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data temperature terbaru
        $temperature = Sensor_data::where('sensor_name', 'temperature')
                        ->latest()
                        ->first();

        // Ambil semua data temperature untuk chart
        $chartData = Sensor_data::where('sensor_name', 'temperature')
                        ->latest()
                        ->take(10)
                        ->get()
                        ->reverse();

        // Ambil log terbaru
        $logs = Sensor_data::latest()
                    ->take(10)
                    ->get();

        return view('dashboard-petugas', compact(
            'temperature',
            'chartData',
            'logs'
        ));
    }
}