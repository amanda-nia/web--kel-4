<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// Import kedua controller
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

// ==========================================
// 1. HALAMAN UTAMA (Kembali ke Halaman Welcome Bawaan)
// ==========================================
Route::get('/', function () {
    return view('welcome');
});


// ==========================================
// 2. FITUR & AUTENTIKASI USER (WARGA)
// ==========================================
Route::get('/register-user', function () {
    return view('register-user');
});

Route::post('/register-user', function (Request $request) {
    DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
    ]);
    return redirect('/login-user');
});

Route::get('/login-user', function () {
    return view('login-user');
});

Route::post('/login-user', function (Request $request) {
    $user = DB::table('users')
        ->where('email', $request->email)
        ->where('password', $request->password)
        ->first();

    if ($user) {
        session([
            'login_user' => true,
            'name' => $user->name,
            'email' => $user->email
        ]);
        // PAS: User masuk ke Dashboard User lewat UserController
        return redirect('/dashboard-user');
    } else {
        return back()->with('error', 'Email atau password salah');
    }
});

// Menampilkan Dashboard User via UserController
Route::get('/dashboard-user', [UserController::class, 'index']);


// ==========================================
// 3. FITUR & AUTENTIKASI PETUGAS
// ==========================================
Route::get('/login-petugas', function () {
    return view('login-petugas');
});

Route::post('/login-petugas', function (Request $request) {
    $user = DB::table('petugas')
        ->where('email', $request->email)
        ->where('password', $request->password)
        ->first();

    if ($user) {
        session([
            'login_petugas' => true,
            'nama' => $user->nama,
            'email' => $user->email
        ]);
        // PAS: Petugas masuk ke Dashboard Petugas lewat DashboardController
        return redirect('/dashboard-petugas');
    } else {
        return back()->with('error', 'Akun mu tidak terdaftar');
    }
});

// Menampilkan Dashboard Petugas via DashboardController (Mengambil data sensor)
Route::get('/dashboard-petugas', [DashboardController::class, 'index']);


// ==========================================
// 4. LOGOUT & FITUR LAINNYA
// ==========================================
Route::get('/logout', function () {
    session()->flush();
    return redirect('/'); // Setelah logout, balik lagi ke halaman welcome
});

Route::get('/log-activity', function () {
    return view('log-activity');
});

Route::get('/map', function () {
    return view('map'); 
})->name('map');