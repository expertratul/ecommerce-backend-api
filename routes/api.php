<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ProductSliderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Brand Routes
Route::get('/brandList', [BrandController::class, 'brandList'])->name('brand.list');
Route::post('/brandStore', [BrandController::class, 'brandStore'])->name('brand.create');
Route::post('/brandShow/{id}', [BrandController::class, 'brandShow'])->name('brand.show');
Route::post('/brand/update/{id}', [BrandController::class, 'brandUpdate'])->name('brand.update');
Route::post('/brand/delete/{id}', [BrandController::class, 'brandDestroy'])->name('brand.delete');

// Category Routes
Route::get('/categoryList', [CategoryController::class, 'categoryList'])->name('category.list');
Route::post('/categoryStore', [CategoryController::class, 'categoryStore'])->name('category.create');
Route::post('/categoryShow/{id}', [CategoryController::class, 'categoryShow'])->name('category.show');
Route::post('/category/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update');
Route::post('/category/delete/{id}', [CategoryController::class, 'categoryDestroy'])->name('category.delete');

//Product Routes
Route::get('/productListByCategory/{id}', [ProductController::class, 'productListByCategory'])->name('products.listByCategory');
Route::get('/productListByBrand/{id}', [ProductController::class, 'productListByBrand'])->name('products.listByBrand');
Route::get('/productListByRemark/{remark}', [ProductController::class, 'productListByRemark'])->name('products.listByRemark');
Route::get('/productListSlider', [ProductSliderController::class, 'productListSlider'])->name('products.listSlider');
Route::get('/productDetailsById/{id}', [ProductDetailController::class, 'productDetailsById'])->name('products.detailsById');   

Route::get('/productReviewList/{product_id}', [ProductReviewController::class, 'ProductReviewList'])->name('products.reviewList');






