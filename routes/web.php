<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\WishListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('category/{slug}', [CategoryController::class, 'productsBySlug'])->name('category.products');
Route::prefix('products')->group(function () {
    Route::get('/{slug}', [ProductController::class, 'details'])->name('products.details');
    Route::post('/reviews/store', [ProductController::class, 'storeReview'])->name('products.reviews.store');
});
Route::prefix('wishlist')->group(function() {
    Route::get('wishlist', [WishListController::class, 'index'])->name('wishlist');
    Route::post('wishlist/toggle', [WishListController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('wishlist/destroy', [WishListController::class, 'destroy'])->name('wishlist.destroy');
});
Route::prefix('site')->group(function(){
    Route::get('cart', function(){})->name('site.cart.add');
});
