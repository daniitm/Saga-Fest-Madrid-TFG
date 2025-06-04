<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CelebrityController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SpaceController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BuyTicketsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/celebrity/{id}', [HomeController::class, 'showCelebrity'])->name('celebrity.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/terms-conditions', function () {
    return view('terms-conditions');
})->name('terms-conditions');

Route::get('/legal-advise', function () {
    return view('legal-advise');
})->name('legal-advise');


// Ruta pública para fetch de celebridades disponibles por token
Route::get('admin/events/available-celebrities', [EventController::class, 'availableCelebrities']);

// routes admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('celebrities', CelebrityController::class); 
    Route::resource('tickets', TicketController::class)->except(['show']); 
    Route::resource('events', EventController::class); 
    Route::resource('spaces', SpaceController::class)->except(['show', 'edit', 'update']); 
    Route::resource('schedules', ScheduleController::class); 
    // Rutas personalizadas para edición de turnos y descanso
    Route::get('schedules/{schedule}/edit-turn', [ScheduleController::class, 'editTurn'])->name('schedules.edit-turn');
    Route::put('schedules/{schedule}/update-turn', [ScheduleController::class, 'updateTurn'])->name('schedules.updateTurn');
    Route::get('schedules/{schedule}/edit-break', [ScheduleController::class, 'editBreak'])->name('schedules.edit-break');
    Route::put('schedules/{schedule}/update-break', [ScheduleController::class, 'updateBreak'])->name('schedules.updateBreak');
    Route::get('spaces/delete', [SpaceController::class, 'delete'])->name('spaces.delete');
    Route::delete('spaces/delete', [SpaceController::class, 'destroy'])->name('spaces.destroy');
    Route::get('tickets/delete', [TicketController::class, 'delete'])->name('tickets.delete');
    Route::delete('tickets/delete', [TicketController::class, 'destroy'])->name('tickets.destroy');
});


require __DIR__.'/auth.php';
