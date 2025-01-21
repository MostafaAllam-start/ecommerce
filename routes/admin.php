<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\VendorController;
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

    Route::prefix('sub_categories')->group(function(){
        Route::get('/', [SubCategoryController::class, 'index'])->name('admin.sub_categories');
        Route::get('/create', [SubCategoryController::class, 'create'])->name('admin.sub_categories.create');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('admin.sub_categories.store');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('admin.sub_categories.edit');
        Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('admin.sub_categories.update');
        Route::get('/delete/{id}', [SubCategoryController::class, 'delete'])->name('admin.sub_categories.delete');
        Route::get('/change_status/{id}', [SubCategoryController::class, 'changeStatus'])->name('admin.sub_categories.change_status');
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

    Route::prefix('products')->group(function(){
        Route::get('/', [ProductController::class, 'index'])->name('admin.products');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');
        Route::get('/change_status/{id}', [ProductController::class, 'changeStatus'])->name('admin.products.change_status');


        Route::get('price/{id}', [ProductController::class, 'showPrice'])->name('admin.products.price');
        Route::post('price/store', [ProductController::class, 'storePrice'])->name('admin.products.price.store');


        Route::get('images/{id}', [ProductController::class, 'uploadImages'])->name('admin.products.images');
        Route::post('images/save', [ProductController::class, 'saveImages'])->name('admin.products.images.save');
        Route::post('images/delete', [ProductController::class, 'deleteImage'])->name('admin.products.images.delete');
        Route::post('images/store', [ProductController::class, 'storeImages'])->name('admin.products.images.store');


        Route::get('stock/{id}', [ProductController::class, 'showStock'])->name('admin.products.stock');
        Route::post('stock/store', [ProductController::class, 'storeStock'])->name('admin.products.stock.store');

    });
    Route::prefix('sliders')->group(function (){
        Route::get('/', [SliderController::class, 'uploadImages'])->name('admin.sliders');
        Route::post('/save', [SliderController::class, 'saveImages'])->name('admin.sliders.save');
        Route::post('/delete', [SliderController::class, 'deleteImage'])->name('admin.sliders.delete');
        Route::post('/store', [SliderController::class, 'storeImages'])->name('admin.sliders.store');
    });
    Route::prefix('tags')->group(function(){
        Route::get('/', [TagController::class, 'index'])->name('admin.tags');
        Route::get('/create', [TagController::class, 'create'])->name('admin.tags.create');
        Route::post('/store', [TagController::class, 'store'])->name('admin.tags.store');
        Route::get('/edit/{id}', [TagController::class, 'edit'])->name('admin.tags.edit');
        Route::post('/update/{id}', [TagController::class, 'update'])->name('admin.tags.update');
        Route::get('/delete/{id}', [TagController::class, 'delete'])->name('admin.tags.delete');
        Route::get('/change_status/{id}', [TagController::class, 'changeStatus'])->name('admin.tags.change_status');
    });

    Route::prefix('attributes')->group(function(){
        Route::get('/', [AttributeController::class, 'index'])->name('admin.attributes');
        Route::get('/create', [AttributeController::class, 'create'])->name('admin.attributes.create');
        Route::post('/store', [AttributeController::class, 'store'])->name('admin.attributes.store');
        Route::get('/edit/{id}', [AttributeController::class, 'edit'])->name('admin.attributes.edit');
        Route::post('/update/{id}', [AttributeController::class, 'update'])->name('admin.attributes.update');
        Route::get('/delete/{id}', [AttributeController::class, 'delete'])->name('admin.attributes.delete');
        Route::get('/change_status/{id}', [AttributeController::class, 'changeStatus'])->name('admin.attributes.change_status');
    });

    Route::prefix('options')->group(function(){
        Route::get('/', [OptionController::class, 'index'])->name('admin.options');
        Route::get('/create', [OptionController::class, 'create'])->name('admin.options.create');
        Route::post('/store', [OptionController::class, 'store'])->name('admin.options.store');
        Route::get('/edit/{id}', [OptionController::class, 'edit'])->name('admin.options.edit');
        Route::post('/update/{id}', [OptionController::class, 'update'])->name('admin.options.update');
        Route::get('/delete/{id}', [OptionController::class, 'delete'])->name('admin.options.delete');
        Route::get('/change_status/{id}', [OptionController::class, 'changeStatus'])->name('admin.options.change_status');
    });


    Route::prefix('test')->group(function(){
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

