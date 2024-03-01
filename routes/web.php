<?php

use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ProductController;
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

Route::get('/employeehome', function () {
    return view('employee.employeehome');
})->name('employeehome');

Route::get('/employee', function () {
    return view('owner.employee');
})->name('employee');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $users=User::all();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});

Route::get('/room',[RoomController::class,'room'])->name('room');

Route::get('/text',[RoomController::class,'text'])->name('text');
Route::get('/employeehome',[RoomController::class,'employeehome'])->name('employeehome');


Route::post('/room/add',[RoomController::class,'addroom'])->name('addRoom');
Route::get('/room/edit/{id}',[RoomController::class,'edit']);
Route::post('/room/update/{id}',[RoomController::class,'update']);
Route::get('/room/delete/{id}',[RoomController::class,'delete']);
Route::get('/roomdetail', [RoomController::class, 'roomdetail'])->name('roomdetail');
Route::get('/', [OwnerController::class, 'checkUserType']);
Route::get('/employee',[OwnerController::class,'employee'])->name('employee');
Route::get('/employeedetail',[OwnerController::class,'employeedetail'])->name('employeedetail');

Route::get('/product',[ProductController::class,'product'])->name('product');
Route::post('/product/add',[ProductController::class,'addproduct'])->name('addProduct');
Route::get('/product_types', [ProductController::class, 'product_types'])->name('product_types');
Route::get('/product/edit/{id}', [ProductController::class, 'editProduct']);
Route::post('/product/update/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
Route::get('/product/delete/{id}',[ProductController::class,'deleteProduct']);


Route::middleware(['auth', 'owner'])->group(function () {

    Route::get('/create-user', [OwnerController::class, 'showCreateUserForm'])->name('owner.create.form');
    Route::post('/create-user', [OwnerController::class, 'createUser'])->name('owner.create');
    Route::get('/employee/edit/{id}',[OwnerController::class,'edit']);
    Route::post('/employee/update/{id}',[OwnerController::class,'update']);
    Route::get('/employee/delete/{id}',[OwnerController::class,'delete']);
});