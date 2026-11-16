<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;

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