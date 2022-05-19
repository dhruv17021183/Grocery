<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryWiseController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\itemReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemCartController;
use App\Http\Controllers\ItemLikeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\StripeController;
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
Route::get('/buyAll',function(){
    return view('cart.buyall');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/reset',[OtpController::class,'Otp'])->middleware('auth');
Route::get('/otpverify',[OtpController::class,'otpverify'])->name('otpverify');
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
Route::post('redeem',[OrderController::class,'reedem'])->name('reedem');
Route::get('search',[PostController::class,'search'])->name('search');
Route::post('confirm',[OrderController::class,'orderConfirm'])->name('confirm');
Route::get('myOrders',[OrderController::class,'UsersOrder'])->name('myorders');
Route::post('cancelOrder',[OrderController::class,'cancelOrder'])->name('cancelorder');
Route::get('MyLikes',[PostController::class,'mylikes'])->name('mylikes');
Route::get('RemoveLike',[PostController::class,'removeLike'])->name('removeLike');
Route::get('filter',[PostController::class,'filterBypriceLow'])->name('filter');
Route::post('debit',[StripeController::class,'Pdebit'])->name('debit');
Route::post('cod',[StripeController::class,'cod'])->name('cod');

//like
Route::get('likes',[ItemLikeController::class,'il'])->name('likes');

// Admin
Route::get('AdminOrders',[AdminController::class,'myOrders'])->name('adminorders');
Route::post('Orders',[AdminController::class,'cityorder'])->name('cityorder');
Route::get('status',[AdminController::class,'status'])->name('status');
Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
// Route::get('generate-pdf', [OrderController::class, 'generatePDF'])->name('generatewqapdf');
Auth::routes();
