<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AuthManagerController;
use App\Http\Controllers\HomeLandingController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookinPaymentController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;





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

//User Routes //

// Route::get('/', function () {
//     return view('landing.home');
// });

Route::get('/',[HomeLandingController::class,'HomeIndex']);

Route::get('about-us', function () {
    return view('landing.about-us');
});

Route::get('services', function () {
    return view('landing.services');
});

Route::get('our-rooms',[RoomController::class, 'get_rooms'])->name('rooms.page');

Route::get('contact', function () {
    return view('landing.contact');
});

//BookingPayment Route for user/customer
Route::get('/book-room', [BookingController::class, 'bookRoomindex'])->name('booking.form');
Route::post('/book-room', [BookingController::class, 'bookRoom'])->name('booking.form.submit');
Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');
Route::get('/booking/cancel', [BookingController::class, 'booking_payment_cancel'])->name('booking.cancel');
Route::get('payment-booking',[BookinPaymentController::class ,'PaymentIndex'])->name('payment.page');

// Route for checking room availability (AJAX - GET)
Route::get('/check-availability', [BookingController::class, 'checkAvailability'])->name('booking.checkAvailability');
//Admin dashboard Middleware Routes
Route::middleware(['ifadmin'])->group(function () {
    Route::resource('admin-dashboard', AdminController::class);
    // Add other routes that require admin access

    // Route::resource('admin-dashboard',AdminController::class)->middleware(['auth','admin']);?
    // Add other routes that require admin access



//Admin SideBar Routes//
// Route::resource('admin-dashboard',AdminController::class);

//RoomTypes Routes//
Route::resource('roomtypes',RoomTypeController::class);
//Deleting RoomTypes Route//
Route::delete('roomtypes/{id}/delete',[RoomTypeController::class,'destroy'])->name('roomtype.delete');
//Deleting RoomTypes Images
// Route::get('roomtypes/{id}/delete/',[RoomTypeController::class,'destroy_roomtype_img']);

// Admin booking crud route//
Route::get('booking-list',[BookingController::class,'AdminBookingIndex'])->name('booking.list');
Route::get('/adminbookinglist-delete/{id}', [BookingController::class, 'AdminBookingdestroy'])->name('bookinglist.delete');

//Room Routes//
Route::resource('rooms',RoomController::class);
//Deleting Room Route
// Route::get('rooms/{id}/delete',[RoomController::class,'destroy']);
Route::delete('/rooms-delete/{id}', [RoomController::class, 'destroy'])->name('rooms.delete');

//Department Routes//
Route::resource('departments',DepartmentController::class);
//Deleting Department Route
Route::delete('departments/{id}/delete',[DepartmentController::class,'destroy'])->name('department.delete');

//Staffs Routes//
Route::resource('staffs',StaffController::class);
//Deleting Staffs Route
Route::get('staffs/{id}/delete',[StaffController::class,'destroy']);

//Roles, Permission & User Routes//

Route::get('/roles', [RolesController::class, 'index'])->name('roles');
Route::get('/roles-create', [RolesController::class, 'create'])->name('roles.create');
Route::get('/roles-edit/{id}', [RolesController::class, 'edit'])->name('roles.edit');
Route::post('/roles-store', [RolesController::class, 'store'])->name('roles.store');
Route::put('/roles-update/{role}', [RolesController::class, 'update'])->name('roles.update');
Route::get('/roles-list', [RolesController::class, 'getRoles'])->name('roles.list');
Route::delete('/roles-delete/{id}', [RolesController::class, 'destroy'])->name('roles.delete');



// UserPERMISISON
Route::get('/user-permissions/{id}', [UsersController::class, 'userPermission'])->name('user.permissions');
Route::post('/user-permissions-update', [UsersController::class, 'updatePermission'])->name('user.permissions.update');


Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/user-create', [UserController::class, 'create'])->name('users.create');
Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::post('/user-store', [UserController::class, 'store'])->name('users.store');
Route::put('/user-update/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users-list', [UserController::class, 'getUsers'])->name('users.list');
Route::delete('/user-delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
});

//Auth Login Routes
Route::get('/login', [LoginController::class,'login_index'])->name('login');
Route::post('/login', [LoginController::class,'store'])->name('login.post');
Route::get('/register', [RegisterController::class,'register_index'])->name('register');
Route::post('/register', [RegisterController::class,'store'])->name('register.post');

// Show Rooms warning Message IN login Blade
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');


// Auth logout Route
Route::get('/logout', [LoginController::class,'logout'])->name('logout');

////Forgot Email & Reset Password Routes 
Route::middleware('guest')->group(function () {
    

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

// Auth::routes();
// Route::get('/users', [UsersController::class, 'index'])->name('users.index');

