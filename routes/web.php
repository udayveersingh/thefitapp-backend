<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard')->middleware('is_admin'); 
Route::get('users',[LoginController::class,'index'])->name('users');
Route::get('login', [LoginController::class, 'Login'])->name('login');
Route::get('signout', [LoginController::class, 'signOut'])->name('signout');
Route::post('get-user', [LoginController::class, 'getUsers'] )->name('get-user');
Route::post('user-login', [LoginController::class, 'UserLogin'])->name('user-login'); 

//Task 
Route::resource('task', App\Http\Controllers\TaskController::class);

