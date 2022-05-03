<?php

use App\Http\Controllers\CategoryWiseController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\itemReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemCartController;
use App\Http\Controllers\OrderController;
use App\Models\Order;

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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/reset',[OtpController::class,'Otp']);
// Route::resource('/items',PostController::class);
Route::resource('items',PostController::class)->only(['index','show','create','store','edit','update','destroy']);
Route::resource('items.reviews',itemReviewController::class)->only(['store']);
Route::get('Addcart',[ItemCartController::class,'usercart'])->name('items.cart');
Route::get('mcart',[ItemCartController::class,'mycart'])->name('users.cart');
Route::delete('deleteCart/{id}',[ItemCartController::class,'removeCart'])->name('remove.cart');
Route::get('/ordernow/{id}',[OrderController::class,'orderdetails'])->name('on');
Route::post('/orderstore/{id}',[OrderController::class,'store'])->name('orderstore');
Route::get('/category/{itemc}',[CategoryWiseController::class,'categorywise'])->name('CategoryWise');
Route::get('/orderConfirm',[OrderController::class,''])->name('orderConfirm');
// Route::get('/redeem',[OrderController::class,'reedem'])->name('reedem');
Route::get('search',[PostController::class,'search'])->name('search');
Auth::routes();
