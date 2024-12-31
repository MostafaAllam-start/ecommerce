<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VendorController;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::middleware('guest')->namespace('Admin')->group(function(){
    Route::get('/login', [AdminLoginController::class, 'getLogin'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'postLogin'])->name('admin.postlogin');
});


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


    Route::prefix('categories')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
        Route::get('/change_status/{id}', [CategoryController::class, 'changeStatus'])->name('admin.categories.change_status');
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


    Route::prefix('brands')->group(function(){
        Route::get('/', [BrandController::class, 'index'])->name('admin.brands');
        Route::get('/create', [BrandController::class, 'create'])->name('admin.brands.create');
        Route::post('/store', [BrandController::class, 'store'])->name('admin.brands.store');
        Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('admin.brands.edit');
        Route::post('/update/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
        Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('admin.brands.delete');
        Route::get('/change_status/{id}', [BrandController::class, 'changeStatus'])->name('admin.brands.change_status');
    });

    Route::prefix('test')->group(function(){
        Route::get('/sub_categories/', function(){
            $categories = Category::findOrFail(4);
            return $categories->subCategories;
        });
        Route::get('/categories', function(){
            $sub_category = SubCategory::findOrFail(1);
            return $sub_category->mainCategory;
        });


        //handling file upload by using custom disks
        Route::get('/upload_photo/', function(){
            return view('admin.test.create');
        })->name('admin.test.upload_photo');
        Route::post('/store_photo/', function(Request $request){
            saveFile($request->file('photo'), 'brands');
            return redirect()->route('admin.test.list_photos');
        })->name('admin.test.store_photo');
        Route::get('/list_photos/', function(){
            $files = Storage::disk('brands')->files();
            foreach($files as $key => $file){
                $files[$key] = Storage::disk('brands')->url($file);
            }
            return view('admin.test.list', compact('files'));
        })->name('admin.test.list_photos');
        Route::get('/delete_photo/{name}', function($name){
            Storage::disk('brands')->delete($name);
            return redirect()->route('admin.test.list_photos');
        })->name('admin.test.delete_photo');
    });
});


