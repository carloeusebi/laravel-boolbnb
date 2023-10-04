<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Models\Apartment;
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


Route::get('apartments', [ApartmentController::class, 'index']);
Route::get('apartments/{slug}', [ApartmentController::class, 'show']);
Route::get('services', [ServiceController::class, 'index']);
