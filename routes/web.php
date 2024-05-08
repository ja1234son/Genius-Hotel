<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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
    return view('landing.home');
});

//Admin SideBar Routes//
Route::resource('admin-dashboard',AdminController::class);

//RoomTypes Routes//
Route::resource('roomtypes',RoomTypeController::class);
//Deleting RoomTypes Route//
Route::get('roomtypes/{id}/delete',[RoomTypeController::class,'destroy']);
//Deleting RoomTypes Images
// Route::get('roomtypes/{id}/delete/',[RoomTypeController::class,'destroy_roomtype_img']);


//Room Routes//
Route::resource('rooms',RoomController::class);
//Deleting Room Route
Route::get('rooms/{id}/delete',[RoomController::class,'destroy']);

//Department Routes//
Route::resource('departments',DepartmentController::class);
//Deleting Department Route
Route::get('departments/{id}/delete',[DepartmentController::class,'destroy']);

//Staffs Routes//
Route::resource('staffs',StaffController::class);
//Deleting Staffs Route
Route::get('staffs/{id}/delete',[StaffController::class,'destroy']);



// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/users', [UsersController::class, 'index'])->name('users.index');

