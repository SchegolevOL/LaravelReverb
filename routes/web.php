<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'pages.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'pages.profile')
    ->middleware(['auth'])
    ->name('profile');

Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index')->name('users.index');
    Route::get('chat/{id}', 'userChat')->name('users.chat');

})->name('users.index')->middleware(['auth'])->name('profile');;



require __DIR__.'/auth.php';
