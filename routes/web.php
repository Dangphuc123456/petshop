<?php

use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ServicesController;
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
//phần sản phẩm,tìm kiếm ,danh mục
Route::get('/', [HomeController::class, 'index'])->name('User.home');
Route::get('/category/{category_id}', [HomeController::class, 'category'])->name('User.category');
Route::get('/product/{type}/{category_id?}', [HomeController::class, 'getProductsByCategory'])->name('User.product');
Route::get('productdetails/{pet_id}', [HomeController::class, 'productdetails'])->name('User.productdetails');
Route::get('/about', [HomeController::class, 'about'])->name('User.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('User.contact');
Route::get('/content', [HomeController::class, 'content'])->name('User.content');
Route::get('/news', [HomeController::class, 'news'])->name('User.news');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/serviceandhotel', [HomeController::class, 'serviceandhotel'])->name('User.serviceandhotel');

//đăng ký đăng nhập
Route::get('/login',[LoginController::class,'showlogin'])->name('User.login');
Route::post('/login', [LoginController::class, 'login'])->name('User.login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('User.logout');
Route::get('/register',[RegisterController::class,'showregister'])->name('User.register');
Route::post('/register', [RegisterController::class, 'register'])->name('User.register.submit');


// phần giỏ hàng
Route::get('cart', [CartController::class, 'cart'])->name('User.cart');
Route::post('/cart/add/{pet_id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/remove-from-cart/{pet_id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
//thanh toán đặt hàng
Route::get('checkout',[CheckoutController::class, 'checkout'])->name('User.checkout');
Route::post('checkout/payment',[CheckoutController::class, 'payment'])->name('User.checkout.payment');
Route::get('checkout/failure', [CheckoutController::class, 'failure'])->name('User.checkout.failure');
//lịch sử đơn hàng
Route::get('/orders/pending', [OrderController::class, 'pendingOrders'])->name('User.orders.pending');
Route::get('/orders/completed', [OrderController::class, 'completedOrders'])->name('User.orders.completed');

//lịch sử dịch vụ
Route::get('/orders/servicehistory', [ServicesController::class, 'servicehistory'])->name('User.orders.servicehistory');
Route::get('/orders/appointment', [ServicesController::class, 'appointment'])->name('User.orders.appointment');

//profile
Route::middleware('auth:customer')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('User.orders.profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('User.profile.update');
});
