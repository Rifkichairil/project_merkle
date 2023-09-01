<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GuestBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('login', [AuthController::class, 'doLogin'])->name('login');

Route::middleware('auth:sanctum')->controller(AuthController::class)->group(function(){
    Route::get('dashboard', 'doDashboard')->name('dashboard');
    Route::post('logout', 'doLogout')->name('logout');
});

Route::controller(GuestBookController::class)->group(function(){
    Route::get('note-gallery', 'doNote')->name('note.gallery');
    Route::post('guest-book', 'doGuestBook')->name('guest-book.post');
});
