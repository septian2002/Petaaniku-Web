<?php

use App\Http\Controllers\AnggotaController;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\SubcategoryController;


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function(){
    Route::post('admin',[AuthController::class,'login']);
    // Route::post('register',[AuthController::class,'register']);
    Route::post('logout',[AuthController::class,'logout']);
    
});

Route::group([
    'middleware' => 'api'
], function(){
    Route::resources([
        'anggotaies' => AnggotaController::class,
        'categories' => CategoryController::class,
        'subcategories' => SubcategoryController::class,
        'sliders' => SliderController::class,
        'products' => ProductController::class,
        'members' => MemberController::class,
        'testimonis' => TestimoniController::class,
        'reviews' => ReviewController::class,
        'orders' => OrderController::class,
        'payments' => PaymentController::class,
    ]);

    Route::get('pesanan/dikonfirmasi', [OrderController::class,'dikonfirmasi']);
    Route::get('pesanan/baru', [OrderController::class,'baru']);
    Route::post('pesanan/baru', [OrderController::class,'tambahPesanan']);
    // Route::get('pesanan/dikemas', [OrderController::class,'dikemas']);
    Route::get('pesanan/dikirim', [OrderController::class,'dikirim']);
    Route::get('pesanan/diterima', [OrderController::class,'diterima']);
    Route::get('pesanan/selesai', [OrderController::class,'selesai']);
    Route::post('pesanan/ubah_status/{order}', [OrderController::class,'ubah_status']);
    Route::get('reports', [ReportController::class,'get_reports']);
    Route::get('pesanan/detail/{order}', [OrderController::class, 'detail']);
});