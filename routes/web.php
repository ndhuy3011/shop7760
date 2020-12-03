<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CkeditorController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\test\Upload;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\user\ContactController;
use App\Http\Controllers\user\Home;
use App\Http\Controllers\user\LoginController;
use App\Http\Controllers\user\ProductController as UserProductController;
use Illuminate\Support\Facades\Route;

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

/*User*/
Route::get('/', [Home::class,'index']);
Route::get('shop',function(){
    return view('page.shop');
});
Route::get('details',function(){
    return view('page.details');
});

/*
    Xác thực thông tin và kiểm tra lại thông tin đơn hàng
*/
Route::get('checkout',[CheckoutController::class,'index'])->middleware("auth");
Route::post('checkout',[CheckoutController::class,'checkout'])->middleware("auth");



Route::get('sanpham/{url}',[UserProductController::class,'showProduct']);

Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('register',[LoginController::class,'Register'])->name('register');
Route::post('login',[LoginController::class,'Login'])->name('login');


Route::get('logout',[LoginController::class,'Logout'])->name('logout');

Route::get('product',[UserProductController::class,'Product']) -> name('product');

Route::get('contact',[ContactController::class,'index']) -> name('contact');
/*
Giỏ hàng
*/
Route::get('Cart',[CartController::class,'show']);
Route::get('removeCart',[CartController::class,'remove']);
Route::get('resetCart',[CartController::class,'reset']);
/**Testttt
 *
 */
Route::get('test',[Upload::class,'index']);
Route::post('test',[Upload::class,'upload']);
Route::post('testCart',[CartController::class,'addCart']);


// Route::get('addCart/{id}',[CartController::class,'addCart']);

//Route Admin
Route::get('admins/login',[AdminLoginController::class,'index']);
Route::post('admins/login',[AdminLoginController::class,'login']);
Route::prefix('admins')->middleware("authadmin")->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    })->name('admin.home');
    Route::get('logout',[AdminLoginController::class,'logout'])->name('admins.logout');
    Route::prefix('sanpham')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admins.sanpham.index');
        //Thêm Sản phẩm
        Route::get('them', [ProductController::class, 'insertShow'])->name('admins.sanpham.them');
        Route::post('them', [ProductController::class, 'insert'])->name('admins.sanpham.them');
        Route::post('themcolor/{id}', [ProductController::class, 'insertColor'])->name('admins.sanpham.themcolor');
        //Update sản phẩm
        Route::get('{id}', [ProductController::class, 'updateShow'])->name('admins.sanpham.update');
        Route::post('product/{id}', [ProductController::class, 'updateProduct'])->name('admins.sanpham.update.product');
        Route::post('color/{id}', [ProductController::class, 'updateNameColor'])->name('admins.sanpham.update.color');
        Route::post('size/{id}', [ProductController::class, 'updateSize'])->name('admins.sanpham.update.size');
        /*Route Xoá sản phẩm*/
        Route::get('xoa/{id}', [ProductController::class, 'delete'])->name('admins.sanpham.xoa');
        /*Route xử lý hình ảnh sản phẩm*/
        Route::get('image/{id}', [ProductController::class, 'imageShow'])->name('admins.sanpham.image');
        Route::post('image', [ProductController::class, 'updateImage'])->name('admins.sanpham.image.update');
        Route::get('image/delete/{id}', [ProductController::class, 'deleteImage'])->name('admins.sanpham.image.delete');
    });
    Route::prefix('danhmuc')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admins.danhmuc.index');
        Route::get('them', [CategoryController::class, 'insertShow'])->name('admins.danhmuc.them');
        Route::post('them', [CategoryController::class, 'insert'])->name('admins.danhmuc.them');
        Route::get('delete', [CategoryController::class, 'delete'])->name('admins.danhmuc.delete');
        Route::get('{url}', [CategoryController::class, 'updateShow'])->name('admins.danhmuc.update');
        Route::post('{url}', [CategoryController::class, 'update'])->name('admins.danhmuc.update');
    });
    Route::prefix('khachhang')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admins.khachhang.index');
    });
    Route::prefix('donhang')->group(function () {
        Route::get('chuaxuly', [InvoiceController::class, 'NoProcess'])->name('admins.donhan.chuaxuly');
        Route::get('hoanthanh', [InvoiceController::class, 'complete'])->name('admins.khachhang.hoanthanh');
        Route::get('handling/{id}',[InvoiceController::class,'handling'])->name('admins.khachhang.dangtienhanh');
        Route::get('detail/{id}',[InvoiceController::class,'detail'])->name('admins.khachhang.chitiet');
    });
});
Route::post('Ckeditor/upload', [CkeditorController::class, 'upload'])->name('ckeditor.upload');
