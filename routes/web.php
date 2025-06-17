<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $category = Category::get();
    $product = Product::get();
    return view('welcome',compact('category','product'));
});

Route::resource('category',CategoryController::class);
Route::resource('product',ProductController::class);
