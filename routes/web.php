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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Middleware\OwnerMiddleware;
use App\Http\Controllers\PaymentTypeController;


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


Route::get('/welcome', [PromotionController::class, 'showPromotionsForHome'])->name('welcome');


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
    Route::get('/dashboardd', function () {
        $users = User::all();
        return view('dashboardd', compact('users'));
    })->name('dashboardd');
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
// Route::post('/cancel-booking/{bookingId}', [BookingController::class, 'cancelBooking']);
Route::post('/cancel-booking/{id}', [PaymentController::class, 'cancelBooking'])->name('cancel.booking');
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);
// รับ booking_id
Route::get('/payment/{booking_id}', [PaymentController::class, 'showPaymentPage'])->name('payment');
Route::post('/update-payment-status', [PaymentController::class, 'updatePaymentStatus']);
Route::get('/check-expired-payments', [PaymentController::class, 'checkAndCancelExpiredPayments']);

Route::get('/checkin', [BookingController::class, 'checkinuser'])->name('checkin');
Route::post('/select-room', [BookingController::class, 'selectRoom'])->name('selectRoom');
Route::get('/checkindetail/{id}', [BookingController::class, 'checkindetail'])->name('checkindetail');
Route::get('/checkoutdetail/{id}', [BookingController::class, 'checkoutdetail'])->name('checkoutdetail');
Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout');

Route::post('/extend-checkout', [BookingController::class, 'extendCheckout'])->name('extendCheckout');
Route::post('/save-payment', [BookingController::class, 'savePayment'])->name('savePayment');

Route::post('/submit-damaged-items', [BookingController::class, 'submitDamagedItems'])->name('submitDamagedItems');
Route::post('/checkout-user', [BookingController::class, 'checkoutuser'])->name('checkoutuser');
Route::post('/checkoutuser', [BookingController::class, 'checkoutuser'])->name('checkoutuser');

Route::post('/addBooking/{id}', [BookingController::class, 'addBooking'])->name('addBooking');
Route::get('/emroom', [BookingController::class, 'emroom'])->name('emroom');
Route::get('/pending-room-selection', [BookingController::class, 'showPendingRoomSelection'])->name('bookings.showPendingRoomSelection');

Route::post('/emaddBooking/{id}', [BookingController::class, 'emaddBooking'])->name('emaddBooking');
Route::post('/em_reserve/{id}', [BookingController::class, 'emaddBooking']);
Route::get('/em_reserve/{id}', [BookingController::class, 'em_reserve'])->name('em_reserve');
Route::get('/receipt', [BookingController::class, 'receiptpickuprent'])->name('receipt');
Route::get('/receipt/{id}', [BookingController::class, 'receiptpickuprent'])->name('receipt.pickup');
Route::get('/tt', [BookingController::class, 'receiptpickuprentt'])->name('tt');
Route::get('/tt/{id}', [BookingController::class, 'receiptpickuprentt'])->name('tt.pickup');

Route::post('/cleanroom/{id}', [RoomController::class, 'cleanroom'])->name('cleanroom');

Route::post('/maintenances/store', [MaintenanceceController::class, 'store'])->middleware('auth');
Route::get('/maintenancedetail/{booking_detail_id}', [MaintenanceceController::class, 'showMaintenanceDetail'])->name('maintenancedetail');
Route::get('repairreport', [MaintenanceceController::class, 'repairreport'])->name('repairreport');
Route::put('/thing-status/{id}', [MaintenanceceController::class, 'updateThingStatus'])->name('updateThingStatus');
Route::put('/thing-status/{id}/complete', [MaintenanceceController::class, 'markAsCompleted'])->name('markAsCompleted');
Route::put('/update-multiple-thing-status', [MaintenanceceController::class, 'updateMultipleThingStatus'])->name('updateMultipleThingStatus');
Route::put('/toggle-repair-type/{id}', [MaintenanceceController::class, 'toggleRepairType'])->name('toggleRepairType');

Route::get('/expenses', [ExpenseController::class, 'expenses'])->name('expenses');
Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
Route::get('/expenses/{id}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');
Route::put('/expenses/{id}', [ExpenseController::class, 'update'])->name('expenses.update');




Route::post('/submit_maintenance', [MaintenanceceController::class, 'store'])->name('submit_maintenance');
Route::post('/repair/update-status/{id}', [MaintenanceceController::class, 'updateRepairStatus'])->name('updateRepairStatus');

Route::get('/maintenanceroom', [MaintenanceceController::class, 'maintenanceroom'])->name('maintenanceroom');
Route::get('/maintenancedetail/{booking_detail_id}', [MaintenanceceController::class, 'maintenancedetail'])->name('maintenancedetail');
Route::post('/toggleRoomStatus/{id}', [MaintenanceceController::class, 'toggleRoomStatus'])->name('toggleRoomStatus');
Route::post('/update-booking-detail', [BookingController::class, 'updateBookingDetail'])->name('updateBookingDetail');
Route::get('/booking/{id}/pdf', [BookingController::class, 'generatePdf'])->name('booking.generatePdf');

Route::get('/', [OwnerController::class, 'checkUserType']);


Route::middleware(['auth', 'owner'])->group(function () {
    Route::prefix('payment_types')->group(function () {
        Route::get('/', [PaymentTypeController::class, 'index'])->name('payment_types.index');
        Route::get('/create', [PaymentTypeController::class, 'create'])->name('payment_types.create');
        Route::post('/store', [PaymentTypeController::class, 'store'])->name('payment_types.store');
        Route::get('/edit/{id}', [PaymentTypeController::class, 'edit'])->name('payment_types.edit');
        Route::put('/{id}', [PaymentTypeController::class, 'update'])->name('payment_types.update');
        Route::delete('/{id}', [PaymentTypeController::class, 'destroy'])->name('payment_types.destroy');
    });
});

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
    Route::get('/employeedetail/{id}', [OwnerController::class, 'employeedetail'])->name('employeedetail');
    Route::get('/product', [ProductController::class, 'product'])->name('product');
    Route::get('/Items', [ProductController::class, 'Items'])->name('Items');

    Route::get('/add_productroom', [ProductRoomController::class, 'add_productroom'])->name('add_productroom');
    Route::get('/productroom', [ProductRoomController::class, 'productroom'])->name('productroom');
    Route::post('/productroom/add', [ProductRoomController::class, 'addProductroom'])->name('addProductroom');

    Route::post('/product/add', [ProductController::class, 'addproduct'])->name('addProduct');
    Route::post('/items/add', [ProductController::class, 'additem'])->name('additem');
    Route::get('/add_items', [ProductController::class, 'add_items'])->name('add_items');
    Route::get('/items', [ProductController::class, 'items'])->name('items');
    Route::get('/product/edit/{id}', [ProductController::class, 'editProduct']);
    Route::post('/product/update/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
    Route::get('/product/delete/{id}', [ProductController::class, 'deleteProduct']);
    Route::get('/add_product', [ProductController::class, 'add_product'])->name('add_product');

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/owner/dashboard', [DashboardController::class, 'dashboard'])->name('owner.dashboard');
    Route::get('/custom-dashboard', [DashboardController::class, 'customDashboard'])->name('custom-dashboard');
    Route::post('/dashboard/filter', [DashboardController::class, 'filterDashboardData']);
    Route::get('/dashboard/revenue', [DashboardController::class, 'getRevenueData']);

    Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions');
    Route::get('/promotions/create', [PromotionController::class, 'create'])->name('add_promotion');
    Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('/promotions/edit/{promotion}', [PromotionController::class, 'edit'])->name('editpromotion');
    Route::put('/promotions/{promotion}', [PromotionController::class, 'update'])->name('promotions.update');
    Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.destroy');
    Route::post('/promotions/{id}/toggle-status', [PromotionController::class, 'toggleStatus'])->name('promotions.toggleStatus');
    Route::get('/record_detail/{id}', [BookingController::class, 'record_detail'])->name('record_detail');
    Route::get('/record', [BookingController::class, 'record'])->name('record');
    Route::get('/test', [BookingController::class, 'test'])->name('test');
    Route::get('/calendar', [BookingController::class, 'calendar'])->name('calendar');
});
