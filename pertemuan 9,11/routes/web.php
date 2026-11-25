<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Route CRUD Program
Route::get('/programs', [ProgramController::class, 'index'])
    ->name('programs.index');

Route::get('/programs/create', [ProgramController::class, 'create'])
    ->name('programs.create');

Route::post('/programs', [ProgramController::class, 'store'])
    ->name('programs.store');

Route::get('/programs/{id}/edit', [ProgramController::class, 'edit'])
    ->name('programs.edit');

Route::put('/programs/{id}', [ProgramController::class, 'update'])
    ->name('programs.update');

Route::delete('/programs/{id}', [ProgramController::class, 'destroy'])
    ->name('programs.destroy');

// Route CRUD User
Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

Route::get('/users/create', [UserController::class, 'create'])
    ->name('users.create');

Route::post('/users', [UserController::class, 'store'])
    ->name('users.store');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit');

Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('users.update');

Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy');