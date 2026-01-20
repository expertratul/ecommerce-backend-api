<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductWishController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ProductSliderController;
use App\Http\Middleware\tokenVerificationMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//User Authentication (API) Routes
Route::get('/userLogin/{userEmail}', [UserController::class, 'userLogin']);
Route::get('/userVerify/{userEmail}/{otp}', [UserController::class, 'verifyLogin']);
Route::get('/logout',[UserController::class,'userLogout']);

// Brand (API) Routes
Route::get('/brandList', [BrandController::class, 'brandList'])->name('brand.list');
Route::post('/brandStore', [BrandController::class, 'brandStore'])->name('brand.create');
Route::post('/brandShow/{id}', [BrandController::class, 'brandShow'])->name('brand.show');
Route::post('/brand/update/{id}', [BrandController::class, 'brandUpdate'])->name('brand.update');
Route::post('/brand/delete/{id}', [BrandController::class, 'brandDestroy'])->name('brand.delete');

// Category (API) Routes
Route::get('/categoryList', [CategoryController::class, 'categoryList'])->name('category.list');
Route::post('/categoryStore', [CategoryController::class, 'categoryStore'])->name('category.create');
Route::post('/categoryShow/{id}', [CategoryController::class, 'categoryShow'])->name('category.show');
Route::post('/category/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update');
Route::post('/category/delete/{id}', [CategoryController::class, 'categoryDestroy'])->name('category.delete');

//Product (API) Routes
Route::get('/productListByCategory/{id}', [ProductController::class, 'productListByCategory'])->name('products.listByCategory');
Route::get('/productListByBrand/{id}', [ProductController::class, 'productListByBrand'])->name('products.listByBrand');
Route::get('/productListByRemark/{remark}', [ProductController::class, 'productListByRemark'])->name('products.listByRemark');
Route::get('/productListSlider', [ProductSliderController::class, 'productListSlider'])->name('products.listSlider');
Route::get('/productDetailsById/{id}', [ProductDetailController::class, 'productDetailsById'])->name('products.detailsById');   
Route::get('/productReviewList/{product_id}', [ProductReviewController::class, 'ProductReviewList'])->name('products.reviewList');

//Product Wishlist (API) Routes
Route::get('/productWishList', [ProductWishController::class, 'productWishList'])->middleware([tokenVerificationMiddleware::class]);
Route::get('/createWishList/{product_id}', [ProductWishController::class, 'productWishCreate'])->middleware([tokenVerificationMiddleware::class]);
Route::get('/deleteWishList/{product_id}', [ProductWishController::class, 'productWishDelete'])->middleware([tokenVerificationMiddleware::class]);

//Product Cart (API) Routes
Route::get('/productCartList', [ProductCartController::class, 'listCartProducts'])->middleware([tokenVerificationMiddleware::class]);
Route::get('/createCartProduct', [ProductCartController::class, 'createCartProduct'])->middleware([tokenVerificationMiddleware::class]);
Route::get('/deleteCartProduct/{product_id}', [ProductCartController::class, 'deleteCartProduct'])->middleware([tokenVerificationMiddleware::class]);

//Product Invoice (API) Routes
Route::get('/invoiceList', [InvoiceController::class, 'invoiceList'])->middleware([tokenVerificationMiddleware::class]);
Route::get('/InvoiceProductList/{invoice_id}', [InvoiceController::class, 'InvoiceProductList'])->middleware([tokenVerificationMiddleware::class]);
Route::get('/place-order', [InvoiceController::class, 'invoiceCreate'])->middleware([tokenVerificationMiddleware::class]);
Route::get('/invoiceDelete', [InvoiceController::class, 'invoiceDelete'])->middleware([tokenVerificationMiddleware::class]);

//payment success, cancel, fail URL (API) Routes
Route::post('/payment/success', [PaymentController::class, 'paymentSuccess'])->middleware([tokenVerificationMiddleware::class]);
Route::post('/payment/cancel', [PaymentController::class, 'paymentCancel'])->middleware([tokenVerificationMiddleware::class]);
Route::post('/payment/fail', [PaymentController::class, 'paymentFail'])->middleware([tokenVerificationMiddleware::class]);

//SSL Account IPN (API) Routes
Route::post('/payment/ipn', [PaymentController::class, 'paymentIPN']);








