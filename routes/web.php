<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

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
            'login' => true,
            'name' => $user->name,
            'email' => $user->email
        ]);

        return redirect('/dashboard-user');

    } else {

        return back()->with('error', 'Email atau password salah');

    }

});

Route::get('/login-petugas', function () {
    return view('login-petugas');
});

Route::get('/dashboard-petugas', function () {
    return view('dashboard-petugas');
});

Route::get('/log-activity', function () {
    return view('log-activity');
});

Route::get('/map', function () {
    return view('map'); 
})->name('map');

Route::post('/login-petugas', function (Request $request) {

    $user = DB::table('petugas')
        ->where('email', $request->email)
        ->where('password', $request->password)
        ->first();

    if ($user) {
        session([
            'login' => true,
            'nama' => $user->nama,
            'email' => $user->email
        ]);

        return redirect('/dashboard-petugas');
    } else {
        return back()->with('error', 'Akun mu tidak terdaftar');
    }
});
use App\Http\Controllers\DashboardController;

Route::get('/dashboard-petugas', [DashboardController::class, 'index']);


// PASTIKAN BARIS DI BAWAH INI ADA:
Route::get('/dashboard-petugas', [DashboardController::class, 'index']);