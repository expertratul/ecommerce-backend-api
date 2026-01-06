<?php

use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductWishController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\tokenVerificationMiddleware;

Route::get('/', function () {
    return view('welcome');
});


//User Authentication Routes
Route::get('/userLogin/{userEmail}', [UserController::class, 'userLogin']);
Route::get('/userVerify/{userEmail}/{otp}', [UserController::class, 'verifyLogin']);
Route::get('/logout',[UserController::class,'userLogout']);

//Product Wishlist Routes
Route::get('/productWishList', [ProductWishController::class, 'productWishList'])->middleware([tokenVerificationMiddleware::class]);
Route::get('/createWishList/{product_id}', [ProductWishController::class, 'productWishCreate'])->middleware([tokenVerificationMiddleware::class]);
Route::get('/deleteWishList/{product_id}', [ProductWishController::class, 'productWishDelete'])->middleware([tokenVerificationMiddleware::class]);

//Product Cart Routes
Route::get('/productCartList', [ProductCartController::class, 'listCartProducts'])->middleware([tokenVerificationMiddleware::class]);
Route::get('/createCartProduct', [ProductCartController::class, 'createCartProduct'])->middleware([tokenVerificationMiddleware::class]);
Route::get('/deleteCartProduct', [ProductCartController::class, 'deleteCartProduct'])->middleware([tokenVerificationMiddleware::class]);
