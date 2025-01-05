<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrizerController;
use App\Http\Controllers\SalonAuthController;

Route::get('/frizeri', [FrizerController::class, 'index']);
Route::put('/frizeri/{id}', [FrizerController::class, 'update']);

Route::post('/login', [SalonAuthController::class, 'login']);