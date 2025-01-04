<?php

use App\Http\Controllers\Backend\ShopSettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/backend/cau-hinh', [ShopSettingController::class, 'index'])->name('backend.shop_settings.index');
Route::get('/backend/cau-hinh/them', [ShopSettingController::class, 'create'])->name('backend.shop_settings.create');
Route::post('/backend/cau-hinh/store', [ShopSettingController::class, 'store'])->name('backend.shop_settings.store');
Route::get('/backend/cau-hinh/{id}', [ShopSettingController::class, 'edit'])->name('backend.shop_settings.edit');
Route::put('/backend/cau-hinh/{id}', [ShopSettingController::class, 'update'])->name('backend.shop_settings.update');
Route::delete('/backend/cau-hinh/{id}', [ShopSettingController::class, 'destroy'])->name('backend.shop_settings.destroy');
