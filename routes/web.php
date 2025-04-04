<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InputinvoiController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SuppliersController;
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
Route::get('/newdetail/{id}',[HomeController::class,'newdetail'])->name('User.newdetail');
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

//lịch sử dịch vụ và dịch vụ
Route::get('/booking',[ServicesController::class,'booking'])->name('User.booking');
Route::post('/booking',[ServicesController::class,'bookingstore'])->name('User.booking.submit');
Route::get('/appointment',[ServicesController::class,'showappointment'])->name('User.appointment');
Route::post('/appointment',[ServicesController::class,'store'])->name('User.appointments.submit');
Route::get('/orders/servicehistory', [ServicesController::class, 'servicehistory'])->name('User.orders.servicehistory');
Route::get('/orders/appointment', [ServicesController::class, 'appointment'])->name('User.orders.appointment');

//profile
Route::middleware('auth:customer')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('User.orders.profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('User.profile.update');
});

// Phần của Admin
Route::get('admin', [AdminController::class, 'index'])->name('Admin.admin');
Route::get('/admin/index', [AdminController::class, 'index'])->name('Admin.index');
Route::get('/admin/notifications/new-orders', [AdminController::class, 'fetchNewOrders'])->name('admin.notifications.newOrders');
Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search.index');


Route::prefix('admin')->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('admin.appointments.index');
    Route::post('/appointments/{AppointmentID}/confirm', [AppointmentController::class, 'confirm'])->name('admin.appointments.confirm');
    Route::post('/appointments/{AppointmentID}/complete', [AppointmentController::class, 'complete'])->name('admin.appointments.complete');  
    Route::delete('/appointments/{AppointmentID}/cancel', [AppointmentController::class, 'cancel'])->name('admin.appointments.cancel');
    Route::get('/appointments/detail/{AppointmentID}', [AppointmentController::class, 'detail'])->name('admin.appointments.detail');
});

Route::prefix('admin')->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('admin.booking.index');
    Route::post('/booking/{BookingID}/confirm', [BookingController::class, 'confirm'])->name('admin.booking.confirm');
    Route::post('/booking/{BookingID}/checkout', [BookingController::class, 'checkout'])->name('admin.booking.checkout');  
    Route::delete('/booking/{BookingID}/cancel', [BookingController::class, 'cancel'])->name('admin.booking.cancel');
    Route::get('/booking/detail/{BookingID}', [BookingController::class, 'detail'])->name('admin.booking.detail');
});
/////// categoris//////
Route::prefix('admin')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/destroy/{category_id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/show/{category_id}', [CategoryController::class, 'show'])->name('admin.category.detail');
    Route::get('/category/edit/{category_id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/category/update/{category_id}', [CategoryController::class, 'update'])->name('admin.category.update');
});
//sản phẩm
Route::prefix('admin')->group(function () {
    Route::get('/pets', [ProductController::class, 'index'])->name('admin.pets.index');
    Route::get('/pets/create', [ProductController::class, 'create'])->name('admin.pets.create');
    Route::post('pets/store', [ProductController::class, 'store'])->name('admin.pets.store');
    Route::get('/pets/destroy/{pet_id}', [ProductController::class, 'destroy'])->name('pets.destroy');
    Route::get('/pets/show/{pet_id}', [ProductController::class, 'show'])->name('admin.pets.detail');
    Route::get('/pets/edit/{pet_id}', [ProductController::class, 'edit'])->name('admin.pets.edit');
    Route::put('/pets/update/{pet_id}', [ProductController::class, 'update'])->name('admin.pets.update');
});
//đơn hàng bán
Route::prefix('admin')->group(function () {
    Route::get('/order', [AdminOrderController::class, 'index'])->name('admin.order.index');
    Route::post('/order/confirm/{order_id}', [AdminOrderController::class, 'confirm'])->name('admin.order.confirm');
    Route::delete('/order/{order_id}/cancel', [AdminOrderController::class, 'cancel'])->name('admin.order.cancel');
    Route::get('/order/detail/{order_id}', [AdminOrderController::class, 'detail'])->name('admin.order.detail');
    Route::post('/order/delivered/{order_id}', [AdminOrderController::class, 'delivered'])->name('admin.order.delivered');
    Route::post('/order/delivery/{order_id}', [AdminOrderController::class, 'delivery'])->name('admin.order.delivery');
});
//đăng ký đăng nhập
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
});

/////// Hóa đơn nhập//////
Route::prefix('admin')->group(function () {
    Route::get('/inputinvoi', [InputinvoiController::class, 'index'])->name('admin.inputinvoi.index');
    Route::get('/inputinvoi/create', [InputinvoiController::class, 'create'])->name('admin.inputinvoi.create');
    Route::post('inputinvoi/store', [InputinvoiController::class, 'store'])->name('admin.inputinvoi.store');
    Route::get('/inputinvoi/show/{purchase_order_id}', [InputinvoiController::class, 'show'])->name('admin.inputinvoi.detail');
    Route::get('/inputinvoi/edit/{purchase_order_id}', [InputinvoiController::class, 'edit'])->name('admin.inputinvoi.edit');
    Route::put('/inputinvoi/update/{purchase_order_id}', [InputinvoiController::class, 'update'])->name('admin.inputinvoi.update');
});

/////// Suppliers//////
Route::prefix('admin')->group(function () {
    Route::get('/servicee', [ServiceController::class, 'index'])->name('admin.servicee.index');
    Route::get('/servicee/create', [ServiceController::class, 'create'])->name('admin.servicee.create');
    Route::post('servicee/store', [ServiceController::class, 'store'])->name('admin.servicee.store');
    Route::get('/servicee/show/{service_id}', [ServiceController::class, 'show'])->name('admin.servicee.detail');
    Route::get('/servicee/edit/{service_id}', [ServiceController::class, 'edit'])->name('admin.servicee.edit');
    Route::put('/servicee/update/{service_id}', [ServiceController::class, 'update'])->name('admin.servicee.update');
});
/////phòng////
Route::prefix('admin')->group(function () {
    Route::get('/room', [RoomController::class, 'index'])->name('admin.room.index');
    Route::get('/room/destroy/{RoomID}', [RoomController::class, 'destroy'])->name('room.destroy');
    Route::get('/room/show/{RoomID}', [RoomController::class, 'show'])->name('admin.room.detail');
    Route::post('/room/available/{RoomID}', [RoomController::class, 'available'])->name('admin.room.available');
    Route::post('/room/occupied/{RoomID}', [RoomController::class, 'occupied'])->name('admin.room.occupied');
    Route::post('/room/maintenance/{RoomID}', [RoomController::class, 'maintenance'])->name('admin.room.maintenance');
});
/////// Suppliers//////
Route::prefix('admin')->group(function () {
    Route::get('/suppliers', [SuppliersController::class, 'index'])->name('admin.suppliers.index');
    Route::get('/suppliers/create', [SuppliersController::class, 'create'])->name('admin.suppliers.create');
    Route::post('suppliers/store', [SuppliersController::class, 'store'])->name('admin.suppliers.store');
    Route::get('/suppliers/destroy/{supplier_id}', [SuppliersController::class, 'destroy'])->name('suppliers.destroy');
    Route::get('/suppliers/show/{supplier_id}', [SuppliersController::class, 'show'])->name('admin.suppliers.detail');
    Route::get('/suppliers/edit/{supplier_id}', [SuppliersController::class, 'edit'])->name('admin.suppliers.edit');
    Route::put('/suppliers/update/{supplier_id}', [SuppliersController::class, 'update'])->name('admin.suppliers.update');
});
Route::prefix('admin')->group(function () {
    Route::get('/new', [NewsController::class, 'index'])->name('admin.new.index');
    Route::get('/new/create', [NewsController::class, 'create'])->name('admin.new.create');
    Route::post('new/store', [NewsController::class, 'store'])->name('admin.new.store');
    Route::get('/new/destroy/{id}', [NewsController::class, 'destroy'])->name('new.destroy');
    Route::get('/new/show/{id}', [NewsController::class, 'show'])->name('admin.new.detail');
    Route::get('/new/edit/{id}', [NewsController::class, 'edit'])->name('admin.new.edit');
    Route::put('/new/update/{id}', [NewsController::class, 'update'])->name('admin.new.update');
});