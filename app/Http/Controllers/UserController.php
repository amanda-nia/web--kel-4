<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Fungsi ini khusus untuk menampilkan halaman dashboard user (warga)
        return view('dashboard-user');
    }
}