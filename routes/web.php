<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('guest.home');
})->name('guest.home');

Route::get('/about', function () {
    return view('guest.about');
})->name('guest.about');

Route::get('/game', function () {
    return view('guest.game');
})->name('guest.game');

Route::get('/winning_number', function () {
    return view('guest.winning_number');
})->name('guest.winning_number');

Route::get('/contact', function () {
    return view('guest.contact');
})->name('guest.contact');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->group(function() {
    Route::get('login', [AuthController::class, 'login'])->name('login');
});

Route::prefix('admin')->middleware('jwt_cookie')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('result', function() {
        return view('admin.result');
    })->name('admin.result.index');
});
