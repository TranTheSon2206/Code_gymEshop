<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Product;
use App\Service\Product\ProductServiceInterface;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);


// Route::get('/', function (\App\Repositories\Product\ProductRepositoryInterface $productRepository) {
//     return view('front.index');
//     return User::all();
//     return $productRepository->all();
// });

// Route::get('/', function (ProductServiceInterface $productService) {
//     return view('front.index');
//     return User::all();
//     return $productService->find(2);
// });

// Route::get('shop/product/{id}', [ShopController::class,'show']);

Route::prefix('shop')->group(function(){
    Route::get('/product/{id}', [ShopController::class,'show']);
    Route::post('/product/{id}', [ShopController::class,'postComment']);
    Route::post('shop', [ShopController::class,'index']);
    Route::get('', [ShopController::class, 'index']);
    Route::get('category/{categoryName}',[ShopController::class,'category']);
});

Route::prefix('cart')->group(function () {
    Route::get('add', [CartController::class, 'add']);
    Route::get('/', [CartController::class, 'index']);
    Route::get('delete', [CartController::class, 'delete']);
});