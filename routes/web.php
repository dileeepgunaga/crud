<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.post');
// routes/web.php


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/profile/edit',  [UserController::class, 'edit'])->name('profile.edit');
Route::put('/users/{id}', [UserController::class, 'updateUser'])->name('users.update');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/users', [UserController::class ,'showAllUsers'])->name('display');
