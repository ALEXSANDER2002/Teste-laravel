<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Rotas de autenticação
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('tasks.index');
    });
    
    Route::resource('tasks', TaskController::class);
    Route::post('tasks/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
});

