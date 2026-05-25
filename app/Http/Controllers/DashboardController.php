<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // PASTIKAN BARIS INI ADA untuk mengambil data database

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data dari tabel sensor Anda (sesuaikan 'sensor_data' dengan nama tabel database Anda)
        $sensor = DB::table('sensor_data')->get(); 

        // 2. Kirim variabel $sensor ke file blade
        return view('dashboard-petugas', compact('sensor'));
    }
}