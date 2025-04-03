<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('register');
});


Route::resource('users',UserController::class)->names('users');
Route::get('/logout',[UserController::class,'logout'])->name('logout');
Route::post('/login',[UserController::class,'login'])->name('login');
Route::get('/handlelogin',[UserController::class,'handleLogin'])->name('handleLogin');
Route::post('/register',[UserController::class,'register'])->name('register');
Route::put('/users/{post}', [UserController::class, 'update'])->name('users.update');