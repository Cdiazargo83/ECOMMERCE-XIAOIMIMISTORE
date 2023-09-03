<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\CreateOrder;
use App\Http\Livewire\ShoppingCart;
use GuzzleHttp\Promise\Create;
use App\Http\Controllers\PaidController;
use App\Http\Controllers\SoapController;
use App\Models\Order;
use App\Models\ProductFlex;
use App\Http\Controllers\ProducFlexController;
use App\Http\Controllers\SoapWebServiceController;
use App\Http\Controllers\Admin\ProductController as FlexProdcut;
use App\Http\Controllers\ProductFlexController;



Route::get('/', WelcomeController::class );

Route::get('search', SearchController::class)->name('search');

Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('products/{product}',[ProductController::class, 'show'])->name('products.show');

Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');



Route::middleware(['auth'])->group(function(){

     //ORDERS

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('orders/create', CreateOrder::class)->name('orders.create');

    Route::get('orders/{order}/payment', [OrderController::class,'payment'])->name('order.payment');


    Route::get('orders/{vista}',[OrderController::class, 'vista'])->name('.orders.vista');

   //IZIPAY

    Route::post('/paid/izipay',[PaidController::class,'izipay'])->name('paid.izipay');

    Route::get('orders/{order}/show', [OrderController::class,'show'])->name('orders.show');

});




























//Route::get('paides/{show}',[PaidController::class, 'show'])->name('paides.show');
//Route::post('orders/izipay', [OrderController::class,'izipay'])->name('order.izipay');
//Route::get('/paides/show', function(){return view('/paides/show');})->name('paides.show');
//Route::get('paid/{order}', [PaidController::class, 'show'])->name('orders.show');
//Route::get('/paides/show',[PaidController::class,'show'])->name('paides.show');
