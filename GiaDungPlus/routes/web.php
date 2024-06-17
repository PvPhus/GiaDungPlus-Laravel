<?php

use App\Http\Controllers\cartController;
use App\Http\Controllers\chartController;
use App\Http\Controllers\dogiadungController;
use App\Http\Controllers\hoadonbanController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\loaidogiadungController;
use App\Http\Controllers\taikhoanController;
use App\Http\Controllers\thanhtoanController;
use App\Http\Controllers\khachhangController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});


//Trang Người Dùng
route::get('/index', [IndexController::class, 'index'])->name('giadungplus.home');

//Trang người dùng-Loại đồ gia dụng
Route::get('/index/loaidogiadung/{id}', [loaidogiadungController::class, 'indexHome'])->name('loaidogiadung.show');

//Trnag người dùng-Chi tiết đồ gia dụng
Route::get('/index/detaildogiadung/{id}', [dogiadungController::class, 'detaildogiadung'])->name('detaildogiadung.detail');
Route::post('/index/detaildogiadung/addcart', [cartController::class, 'store'])->name('detaildogiadung.store');
//Route::get('/index/detaildogiadung/taikhoan/{userId}', [dogiadungController::class, 'edit1'])->name('detaildogiadung.edit1');

//Trang người dùng-Giỏ hàng
route::get('/index/cart/{userId}', [cartController::class, 'index'])->name('cart.show');
Route::get('/index/cart/delete/{id}', [cartController::class, 'destroy'])->name('cart.delete');

//Trang người dùng-Giỏ hàng-Lịch sử thanh toán
route::get('/index/cart/lichsu/{userId}', [cartController::class, 'viewHoaDon'])->name('lichsu.show');
Route::get('/index/cart/lichsu/delete/{id}', [cartController::class, 'destroyhoadon'])->name('lichsu.delete');
Route::get('/index/cart/lichsu/chitiet/{id}', [cartController::class, 'viewChiTietHoaDon'])->name('chitiethoadon.detail');


//Trang người dùng-Tài khoản
Route::get('/index/login',[taikhoanController::class, 'login'])->name('login.index');
Route::post('/index/login', [taikhoanController::class, 'checklogin'])->name('login.check');
Route::get('/index/logout',[taikhoanController::class, 'logout'])->name('logout.index');
Route::get('/index/register',[taikhoanController::class, 'register'])->name('register.index');
Route::POST('/index/register',[taikhoanController::class, 'store'])->name('register.store');
Route::get('/index/taikhoan/{userId}',[taikhoanController::class, 'edit'])->name('taikhoan.edit');
Route::post('/index/taikhoan/{userId}',[taikhoanController::class, 'update'])->name('taikhoan.update');

//Trang người dùng-Thanh toán
route::get('/index/cart/thanhtoan/{userId}',[thanhtoanController::class, 'index'])->name('thanhtoan.index');
route::POST('/index/cart/thanhtoan',[thanhtoanController::class, 'store'])->name('thanhtoan.store');


//Trang Admin
Route::get('/admin', [chartController::class, 'index']);

//Trang Admin-Chart
Route::get('/admin/chart', [chartController::class, 'index'])->name('chart.index');

//Trang Admin-Loại đồ gia dụng
Route::get('/admin/loaidogiadung', [loaidogiadungController::class, 'index'])->name('loaidogiadung.index');
Route::get('/admin/loaidogiadung/create', [loaidogiadungController::class, 'create'])->name('loaidogiadung.create');
Route::post('/admin/loaidogiadung/create', [loaidogiadungController::class, 'store'])->name('loaidogiadung.store');
Route::get('/admin/loaidogiadung/detail/{id}', [loaidogiadungController::class, 'detail'])->name('loaidogiadung.detail');
Route::get('/admin/loaidogiadung/edit/{id}', [loaidogiadungController::class, 'edit'])->name('loaidogiadung.edit');
Route::post('/admin/loaidogiadung/edit/{id}', [loaidogiadungController::class, 'update']);
Route::get('/admin/loaidogiadung/delete/{id}', [loaidogiadungController::class, 'destroy'])->name('loaidogiadung.delete');

//Trang Admin-Đồ gia dụng
Route::get('/admin/dogiadung', [dogiadungController::class, 'index'])->name('dogiadung.index');
Route::get('/admin/dogiadung/detail/createcolor/{id}', [dogiadungController::class, 'createMSL'])->name('mausoluong.create');
Route::post('/admin/dogiadung/detail/createcolor/{id}', [dogiadungController::class, 'storeMSL'])->name('mausoluong.store');
Route::get('/admin/dogiadung/detail/delete/{id}', [dogiadungController::class, 'destroyMSL'])->name('mausoluong.delete');

Route::get('/admin/dogiadung/create', [dogiadungController::class, 'create'])->name('dogiadung.create');
Route::post('/admin/dogiadung/create', [dogiadungController::class, 'store'])->name('dogiadung.store');
Route::get('/admin/dogiadung/detail/{id}', [dogiadungController::class, 'detail'])->name('dogiadung.detail');
Route::get('/admin/dogiadung/edit/{id}', [dogiadungController::class, 'edit'])->name('dogiadung.edit');
Route::post('/admin/dogiadung/edit/{id}', [dogiadungController::class, 'update'])->name('dogiadung.update');
Route::get('/admin/dogiadung/delete/{id}', [dogiadungController::class, 'destroy'])->name('dogiadung.delete');

//Trang Admin-Giỏ hàng
Route::get('/admin/cart', [cartController::class, 'index2'])->name('giohang.index');
Route::get('/admin/cart/detail/{id}', [cartController::class, 'detail'])->name('cart.detail');


//Trang Admin-Khách hàng
Route::get('/admin/khachhang', [khachhangController::class, 'index'])->name('khachhang.index');
Route::get('/admin/khachhang/delete/{id}', [khachhangController::class, 'destroy'])->name('khachhang.delete');
Route::get('/admin/khachhang/detail/{id}', [khachhangController::class, 'show'])->name('khachhang.detail');

//Trang Admin-Hóa đơn bán
Route::get('/admin/hoadonban', [hoadonbanController::class, 'index'])->name('hoadonban.index');
Route::post('/admin/hoadonban', [hoadonbanController::class, 'indexandupdate'])->name('hoadonban.indexandupdate');
Route::get('/admin/hoadonban/edit/{id}', [hoadonbanController::class, 'edit'])->name('hoadonban.edit');
Route::post('/admin/hoadonban/edit', [hoadonbanController::class, 'update'])->name('hoadonban.update');
Route::get('/admin/hoadonban/delete/{id}', [hoadonbanController::class, 'destroy'])->name('hoadonban.delete');

//Trang Admin-Tài khoản
Route::get('/admin/taikhoan', [taikhoanController::class, 'index'])->name('taikhoan.index');
Route::get('/admin/taikhoan/{id}', [taikhoanController::class, 'destroy'])->name('taikhoan.destroy');