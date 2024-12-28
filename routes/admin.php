<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\VendorController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function() {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('language')->group(function(){
        Route::get('/', [LanguageController::class, 'index'])->name('admin.languages');
        Route::get('/create', [LanguageController::class, 'create'])->name('admin.languages.create');
        Route::post('/store', [LanguageController::class, 'store'])->name('admin.languages.store');
        Route::get('/edit/{id}', [LanguageController::class, 'edit'])->name('admin.languages.edit');
        Route::post('/update/{id}', [LanguageController::class, 'update'])->name('admin.languages.update');
        Route::get('/delete/{id}', [LanguageController::class, 'delete'])->name('admin.languages.delete');
        Route::get('/change_status/{id}', [LanguageController::class, 'changeStatus'])->name('admin.languages.change_status');
    });


    Route::prefix('main_category')->group(function(){
        Route::get('/', [MainCategoryController::class, 'index'])->name('admin.main_category');
        Route::get('/create', [MainCategoryController::class, 'create'])->name('admin.main_category.create');
        Route::post('/store', [MainCategoryController::class, 'store'])->name('admin.main_category.store');
        Route::get('/edit/{id}', [MainCategoryController::class, 'edit'])->name('admin.main_category.edit');
        Route::post('/update/{id}', [MainCategoryController::class, 'update'])->name('admin.main_category.update');
        Route::get('/delete/{id}', [MainCategoryController::class, 'delete'])->name('admin.main_category.delete');
        Route::get('/change_status/{id}', [MainCategoryController::class, 'changeStatus'])->name('admin.main_category.change_status');
    });

    Route::prefix('vendors')->group(function(){
        Route::get('/', [VendorController::class, 'index'])->name('admin.vendors');
        Route::get('/create', [VendorController::class, 'create'])->name('admin.vendors.create');
        Route::post('/store', [VendorController::class, 'store'])->name('admin.vendors.store');
        Route::get('/edit/{id}', [VendorController::class, 'edit'])->name('admin.vendors.edit');
        Route::post('/update/{id}', [VendorController::class, 'update'])->name('admin.vendors.update');
        Route::get('/delete/{id}', [VendorController::class, 'delete'])->name('admin.vendors.delete');
        Route::get('/change_status/{id}', [VendorController::class, 'changeStatus'])->name('admin.vendors.change_status');
    });
});


Route::middleware('guest')->namespace('Admin')->group(function(){
    Route::get('/login', [AdminLoginController::class, 'getLogin'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'postLogin'])->name('admin.postlogin');
});
