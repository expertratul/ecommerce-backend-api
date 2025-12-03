<?php

use App\Http\Controllers\BrandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Brand Routes
Route::get('/brandList', [BrandController::class, 'brandList'])->name('brand.list');
Route::post('/brandStore', [BrandController::class, 'brandStore'])->name('brand.create');
Route::post('/brandShow/{id}', [BrandController::class, 'brandShow'])->name('brand.show');
Route::post('/brand/update/{id}', [BrandController::class, 'brandUpdate'])->name('brand.update');
Route::post('/brand/delete/{id}', [BrandController::class, 'brandDestroy'])->name('brand.delete');