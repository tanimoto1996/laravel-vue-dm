<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/users/{id}', [App\Http\Controllers\User\UserController::class, 'index'])->name('user.index');
    Route::post('/users/room', [App\Http\Controllers\User\UserController::class, 'privateMessage'])->name('user.room');
    Route::post('/users/room/update', [App\Http\Controllers\User\UserController::class, 'addMessage'])->name('user.roomUpdate');
});