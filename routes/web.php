<?php

use App\Http\Controllers\Backend\ShopSettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/backend/cau-hinh', [ShopSettingController::class, 'index'])->name('backend.shop_settings.index');
