<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'auth.user-signin')->middleware('is_admin');
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard')->middleware('is_admin'); 
Route::get('/login', [LoginController::class, 'Login'])->name('login');
Route::get('/signout', [LoginController::class, 'signOut'])->name('signout');
Route::post('/user-login', [LoginController::class, 'UserLogin'])->name('user-login'); 

//users
Route::get('/users',[UserController::class,'index'])->name('users');
Route::get('/users/{id}/edit',[UserController::class,'edit'])->name('users.edit');
Route::get('/user/{id}/detail/',[UserController::class,'userDetail'])->name('user.detail');
Route::get('/step-trackers-earnings',[UserController::class,'stepTrackerEarnings'])->name('step-trackers-earnings');
Route::get('/referral-earnings',[UserController::class,'referralEarnings'])->name('referral-earnings');
Route::get('/withdrawl-list',[UserController::class,'withdrawlList'])->name('withdrawl-list');
Route::get('/kyc-requests',[UserController::class,'kycRequestList'])->name('kyc-requests');
Route::post('/kyc-update',[UserController::class,'kycUpdateStatus'])->name('kyc-update');

// Route::get('/user/trackers',[UserController::class,'trackers'])->name('user.trackers');
Route::post('/user/update/{id}',[UserController::class,'update'])->name('user.update');

//Task 
Route::get('/tasks', [App\Http\Controllers\TaskController::class,'index'])->name('tasks.index');
Route::get('/tasks/create', [App\Http\Controllers\TaskController::class,'create'])->name('tasks.create');
Route::get('/tasks/{id}/edit',[App\Http\Controllers\TaskController::class,'edit'])->name('tasks.edit');
Route::get('/tasks/delete/{id}',[App\Http\Controllers\TaskController::class,'destroy'])->name('tasks.delete');
Route::post('/tasks/store',[App\Http\Controllers\TaskController::class,'store'])->name('tasks.store');
Route::post('/tasks/update/{id}',[App\Http\Controllers\TaskController::class,'update'])->name('tasks.update');

//Settings
Route::get('/settings', [App\Http\Controllers\SettingController::class,'index'])->name('settings.index');
Route::post('/settings/store',[App\Http\Controllers\SettingController::class,'store'])->name('settings.store');
// Route::get('/settings/create', [App\Http\Controllers\SettingController::class,'create'])->name('settings.create');
// Route::get('/settings/{id}/edit',[App\Http\Controllers\SettingController::class,'edit'])->name('settings.edit');
// Route::get('/settings/delete/{id}',[App\Http\Controllers\SettingController::class,'destroy'])->name('settings.delete');
// Route::post('/settings/update/{id}',[App\Http\Controllers\SettingController::class,'update'])->name('settings.update');

