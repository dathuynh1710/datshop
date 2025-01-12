<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\ShopPostController;
use App\Http\Controllers\Backend\ShopSettingController;
use App\Http\Controllers\API\APIAclRoleHasPermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AclUserHasRoleController;
use App\Http\Controllers\Backend\AclRoleHasPermissionController;



Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/register', [RegisterController::class, 'index'])->name('auth.register.index');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register.register');
Route::get('/register-success', [RegisterController::class, 'registerSuccess'])->name('auth.register.register-success');
Route::get('/active-user', [RegisterController::class, 'activeUser'])->name('auth.register.active-user');
Route::get('/login', [LoginController::class, 'index'])->name('auth.login.index');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.login.logout');

Route::get('/backend/cau-hinh', [ShopSettingController::class, 'index'])->name('backend.shop_settings.index');
Route::get('/backend/cau-hinh/them', [ShopSettingController::class, 'create'])->name('backend.shop_settings.create');
Route::post('/backend/cau-hinh/store', [ShopSettingController::class, 'store'])->name('backend.shop_settings.store');
Route::get('/backend/cau-hinh/{id}', [ShopSettingController::class, 'edit'])->name('backend.shop_settings.edit');
Route::put('/backend/cau-hinh/{id}', [ShopSettingController::class, 'update'])->name('backend.shop_settings.update');
Route::delete('/backend/cau-hinh/{id}', [ShopSettingController::class, 'destroy'])->name('backend.shop_settings.destroy');

Route::get('/backend/bai-viet', [ShopPostController::class, 'index'])->name('backend.shop_posts.index');
Route::get('/backend/bai-viet/create', [ShopPostController::class, 'create'])->name('backend.shop_posts.create');
Route::post('/backend/bai-viet/store', [ShopPostController::class, 'store'])->name('backend.shop_posts.store');
Route::get('/backend/bai-viet/{id}', [ShopPostController::class, 'edit'])->name('backend.shop_posts.edit');
Route::put('/backend/bai-viet/{id}', [ShopPostController::class, 'update'])->name('backend.shop_posts.update');
Route::delete('/backend/bai-viet/{id}', [ShopPostController::class, 'destroy'])->name('backend.shop_posts.destroy');

Route::get('/backend/gan-vai-tro-cho-nguoi-dung', [AclUserHasRoleController::class, 'index'])->name('backend.acl_user_has_roles.index');
Route::get('/backend/gan-vai-tro-cho-nguoi-dung/create', [AclUserHasRoleController::class, 'create'])->name('backend.acl_user_has_roles.create');
Route::post('/backend/gan-vai-tro-cho-nguoi-dung/create', [AclUserHasRoleController::class, 'store'])->name('backend.acl_user_has_roles.store');
Route::get('/backend/gan-vai-tro-cho-nguoi-dung/{username}/create', [AclUserHasRoleController::class, 'create_with_username'])->name('backend.acl_user_has_roles.create_with_username');

Route::get('/api/v1/acl_role_has_permissions/getByRoleId/{role_id?}', [APIAclRoleHasPermissionController::class, 'getByRoleId'])->name('api.acl_role_has_permissions.getByRoleId');
Route::get('/backend/cap-quyen-cho-vai-tro', [AclRoleHasPermissionController::class, 'index'])->name('backend.acl_role_has_permissions.index');
Route::get('/backend/cap-quyen-cho-vai-tro/create', [AclRoleHasPermissionController::class, 'create'])->name('backend.acl_role_has_permissions.create');
Route::post('/backend/cap-quyen-cho-vai-tro/create', [AclRoleHasPermissionController::class, 'store'])->name('backend.acl_role_has_permissions.store');
