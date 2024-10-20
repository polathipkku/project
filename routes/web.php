<?php

use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MaintenanceceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductRoomController;
use App\Http\Controllers\PromotionController;
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

Route::get('/home', [PromotionController::class, 'showPromotionsForHome'])->name('home');
Route::get('/contact', function () {
    return view('user.contact');
})->name('contact');
Route::get('/welcome_2', function () {
    return view('user.welcome_2');
})->name('welcome_2');
Route::get('/travel', function () {
    return view('user.travel');
})->name('travel');
Route::get('/gallery', function () {
    return view('user.gallery');
})->name('gallery');

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
Route::post('/store-information', [BookingController::class, 'storeInformation'])->name('storeInformation');
Route::get('/text', [RoomController::class, 'text'])->name('text');
Route::get('/review/{bookingId}', [ReviewController::class, 'createReview'])->name('review.create');
Route::post('/review', [ReviewController::class, 'submitReview'])->name('review.submit');
Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
Route::get('/employeehome', [RoomController::class, 'employeehome'])->name('employeehome');
Route::get('/userbooking', [BookingController::class, 'userbooking'])->name('userbooking');
Route::get('/t', [BookingController::class, 't'])->name('t');
Route::get('/reserve', [BookingController::class, 'showReserveForm'])->name('reserve');
Route::post('/reserve', [BookingController::class, 'reserve'])->name('bookings.reserve');
// Route::post('/reserves', [BookingController::class, 'reserves'])->name('bookings.reserves');
Route::get('/check-availability', [BookingController::class, 'checkAvailability']);
Route::post('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::get('/employeehome', [BookingController::class, 'employeehome'])->name('employeehome');
Route::get('/reservation', [BookingController::class, 'reservation'])->name('reservation');
Route::get('/store', [ProductController::class, 'store'])->name('store');
Route::post('/buy-product', [ProductController::class, 'buyProduct'])->name('buyProduct');
Route::get('/promotions-home', [PromotionController::class, 'showPromotionsForHome'])->name('promotions.home');
Route::post('/cancel-booking/{id}', [PaymentController::class, 'cancelBooking'])->name('cancel.booking'); // Route::delete('/cancel-booking/{id}', [BookingController::class, 'cancelBooking'])->name('cancel.booking');
// สร้าง Payment Intent
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);
// รับ booking_id
Route::get('/payment/{booking_id}', [PaymentController::class, 'showPaymentPage'])->name('payment');
Route::post('/update-payment-status', [PaymentController::class, 'updatePaymentStatus']);

Route::get('/checkin', [BookingController::class, 'checkinuser'])->name('checkin');
Route::post('/select-room', [BookingController::class, 'selectRoom'])->name('selectRoom');
Route::get('/checkindetail/{id}', [BookingController::class, 'checkindetail'])->name('checkindetail');
Route::get('/checkoutdetail/{id}', [BookingController::class, 'checkoutdetail'])->name('checkoutdetail');
Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout');

Route::post('/extend-checkout', [BookingController::class, 'extendCheckout'])->name('extendCheckout');
Route::post('/save-payment', [BookingController::class, 'savePayment'])->name('savePayment');

Route::post('/checkoutuser', [BookingController::class, 'checkoutuser'])->name('checkoutuser');
Route::post('/submit-damaged-items', [BookingController::class, 'submitDamagedItems'])->name('submitDamagedItems');
Route::post('/damaged-items', [BookingController::class, 'submitDamagedItems'])->name('submitDamagedItems');

Route::post('/addBooking/{id}', [BookingController::class, 'addBooking'])->name('addBooking');
Route::get('/emroom', [BookingController::class, 'emroom'])->name('emroom');
Route::get('/pending-room-selection', [BookingController::class, 'showPendingRoomSelection'])->name('bookings.showPendingRoomSelection');

Route::post('/emaddBooking/{id}', [BookingController::class, 'emaddBooking'])->name('emaddBooking');
Route::post('/em_reserve/{id}', [BookingController::class, 'emaddBooking']);
Route::get('/em_reserve/{id}', [BookingController::class, 'em_reserve'])->name('em_reserve');
Route::post('/cleanroom/{id}', [RoomController::class, 'cleanroom'])->name('cleanroom');

Route::get('/maintenance/{id}', [MaintenanceceController::class, 'maintenance'])->name('maintenance');
Route::post('/submit_maintenance', [MaintenanceceController::class, 'store'])->name('submit_maintenance');
Route::get('/maintenanceroom', [MaintenanceceController::class, 'maintenanceroom'])->name('maintenanceroom');
Route::get('/maintenancedetail/{id}', [MaintenanceceController::class, 'maintenancedetail'])->name('maintenancedetail');
Route::post('/toggleRoomStatus/{id}', [MaintenanceceController::class, 'toggleRoomStatus'])->name('toggleRoomStatus');
Route::post('/update-booking-detail', [BookingController::class, 'updateBookingDetail'])->name('updateBookingDetail');

Route::get('/', [OwnerController::class, 'checkUserType']);




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

    Route::get('/add_productroom', [ProductRoomController::class, 'add_productroom'])->name('add_productroom');
    Route::get('/productroom', [ProductRoomController::class, 'productroom'])->name('productroom');
    Route::post('/productroom/add', [ProductRoomController::class, 'addProductroom'])->name('addProductroom');

    Route::post('/product/add', [ProductController::class, 'addproduct'])->name('addProduct');
    Route::get('/product_types', [ProductController::class, 'product_types'])->name('product_types');
    Route::get('/product/edit/{id}', [ProductController::class, 'editProduct']);
    Route::post('/product/update/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
    Route::get('/product/delete/{id}', [ProductController::class, 'deleteProduct']);
    Route::get('/add_product', [ProductController::class, 'add_product'])->name('add_product');

    Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');

    Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
    Route::get('/payment_types', [PaymentController::class, 'create'])->name('payment_types');
    Route::post('/payment_types/add', [PaymentController::class, 'store'])->name('payment_types');

    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions');
    Route::get('/promotions/create', [PromotionController::class, 'create'])->name('add_promotion');
    Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('/promotions/edit/{promotion}', [PromotionController::class, 'edit'])->name('editpromotion');
    Route::put('/promotions/{promotion}', [PromotionController::class, 'update'])->name('promotions.update');
    Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.destroy');
    Route::post('/promotions/{id}/toggle-status', [PromotionController::class, 'toggleStatus'])->name('promotions.toggleStatus');
    Route::get('/record_detail/{id}', [BookingController::class, 'record_detail'])->name('record_detail');
    Route::get('/record', [BookingController::class, 'record'])->name('record');
});
