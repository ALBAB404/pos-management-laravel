<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\Admin\CategoryController;


Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], static function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('get-category-list', [CategoryController::class, 'get_category_list']);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('sub-categories', SubCategoryController::class);
    Route::apiResource('brands', BrandController::class);
});
