<?php

use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MaintenanceceController;
use App\Http\Middleware\OwnerMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/text', function () {
    return view('owner.text');
})->name('text');

Route::get('/home', function () {
    return view('user.home');
})->name('home');
Route::get('/contact', function () {
    return view('user.contact');
})->name('contact');

Route::get('/userbooking', function () {
    return view('user.userbooking');
})->name('userbooking');

Route::get('/employeehome', function () {
    return view('employee.employeehome');
})->name('employeehome');

Route::get('/employee', function () {
    return view('owner.employee');
})->name('employee');

Route::get('/payment', function () {
    return view('user.payment');
})->name('payment');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});

// Route::get('/userbooking',[BookingController::class,'userbooking'])->name('userbooking');
Route::get('/text', [RoomController::class, 'text'])->name('text');
Route::get('/employeehome', [RoomController::class, 'employeehome'])->name('employeehome');

Route::get('/userbooking', [BookingController::class, 'userbooking'])->name('userbooking');
Route::get('/t', [BookingController::class, 't'])->name('t');
Route::get('/reserve/{id}', [BookingController::class, 'reserve'])->name('reserve');
Route::get('/employeehome', [BookingController::class, 'employeehome'])->name('employeehome');
Route::post('/reserve/{id}', [BookingController::class, 'addBooking']);
Route::get('/reservation', [BookingController::class, 'reservation'])->name('reservation');
Route::delete('/cancelbooking/{id}', [BookingController::class, 'cancelBooking'])->name('cancelBooking');
//payment
// สร้าง Payment Intent
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);
// รับ booking_id
Route::get('/payment/{booking_id}', [PaymentController::class, 'showPaymentPage'])->name('payment');

Route::get('/checkin', [BookingController::class, 'checkin'])->name('checkin');
Route::get('/checkindetail/{id}', [BookingController::class, 'checkindetail'])->name('checkindetail');
Route::get('/checkoutdetail/{id}', [BookingController::class, 'checkoutdetail'])->name('checkoutdetail');
Route::post('/checkinuser', [BookingController::class, 'checkinuser'])->name('checkinuser');
Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout');
Route::post('/checkoutuser', [BookingController::class, 'checkoutuser'])->name('checkoutuser');
Route::post('/addBooking/{id}', [BookingController::class, 'addBooking'])->name('addBooking');
Route::get('/emroom', [BookingController::class, 'emroom'])->name('emroom');
Route::post('/emaddBooking/{id}', [BookingController::class, 'emaddBooking'])->name('emaddBooking');
Route::post('/em_reserve/{id}', [BookingController::class, 'emaddBooking']);
Route::get('/em_reserve/{id}', [BookingController::class, 'em_reserve'])->name('em_reserve');
Route::post('/cleanroom/{id}', [RoomController::class, 'cleanroom'])->name('cleanroom');

Route::get('/maintenance/{id}', [MaintenanceceController::class, 'maintenance'])->name('maintenance');
Route::post('/submit_maintenance', [MaintenanceceController::class, 'store'])->name('submit_maintenance');
Route::get('/maintenanceroom', [MaintenanceceController::class, 'maintenanceroom'])->name('maintenanceroom');
Route::get('/maintenancedetail/{id}', [MaintenanceceController::class, 'maintenancedetail'])->name('maintenancedetail');
Route::post('/toggleRoomStatus/{id}', [MaintenanceceController::class, 'toggleRoomStatus'])->name('toggleRoomStatus');


Route::get('/', [OwnerController::class, 'checkUserType']);

Route::get('/getAvailableRooms', [BookingController::class, 'getAvailableRooms']);



Route::middleware(['auth', 'owner'])->group(function () {

    Route::get('/create-user', [OwnerController::class, 'showCreateUserForm'])->name('owner.create.form');
    Route::post('/create-user', [OwnerController::class, 'createUser'])->name('owner.create');
    Route::get('/employee/edit/{id}', [OwnerController::class, 'edit']);
    Route::post('/employee/update/{id}', [OwnerController::class, 'update']);
    Route::get('/employee/delete/{id}', [OwnerController::class, 'delete']);
    Route::get('/employee/search', [OwnerController::class, 'searchEmployee'])->name('searchEmployee');
});

Route::group(['middleware' => [OwnerMiddleware::class]], function () {
    Route::get('/room', [RoomController::class, 'room'])->name('room');
    Route::get('/add_room', [RoomController::class, 'add_room'])->name('add_room');
    Route::post('/add_room/add', [RoomController::class, 'addroom'])->name('addRoom');
    Route::get('/room/edit/{id}', [RoomController::class, 'edit']);
    Route::post('/room/update/{id}', [RoomController::class, 'update']);
    Route::get('/room/delete/{id}', [RoomController::class, 'delete']);
    Route::get('/roomdetail/{id}', [RoomController::class, 'roomdetail'])->name('roomdetail');

    Route::get('/employee', [OwnerController::class, 'employee'])->name('employee');
    Route::get('/add_employee', [OwnerController::class, 'add_employee'])->name('add_employee');
    Route::get('/employeedetail', [OwnerController::class, 'employeedetail'])->name('employeedetail');
    Route::get('/product', [ProductController::class, 'product'])->name('product');
    Route::post('/product/add', [ProductController::class, 'addproduct'])->name('addProduct');
    Route::get('/product_types', [ProductController::class, 'product_types'])->name('product_types');
    Route::get('/product/edit/{id}', [ProductController::class, 'editProduct']);
    Route::post('/product/update/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
    Route::get('/product/delete/{id}', [ProductController::class, 'deleteProduct']);
    Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');

    Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
    Route::get('/payment_types', [PaymentController::class, 'create'])->name('payment_types');
    Route::post('/payment_types/add', [PaymentController::class, 'store'])->name('payment_types');
});
