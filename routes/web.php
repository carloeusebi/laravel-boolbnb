<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('guest.welcome');
})->name('home');

Route::prefix('/admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/apartments/messages', [MessageController::class, 'index'])->name('apartments.messages');
    Route::get('/apartments/messages/{message}', [MessageController::class, 'show'])->name('apartments.messages.show');
    Route::get('/apartments/trash', [ApartmentController::class, 'trash'])->name('apartments.trash');
    Route::put('/apartments/trash/{apartment}/restore', [ApartmentController::class, 'restore'])->name('apartments.restore');
    Route::put('/apartments/trash/restoreAll', [ApartmentController::class, 'restoreAll'])->name('apartments.restoreAll');
    Route::delete('/apartments/trash/{apartment}/drop', [ApartmentController::class, 'drop'])->name('apartments.drop');
    Route::delete('/apartments/trash/deleteAll', [ApartmentController::class, 'dropAll'])->name('apartments.dropAll');
    Route::resource('apartments', ApartmentController::class);
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
