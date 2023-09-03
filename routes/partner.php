<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Partner\ShowProducts;

use App\Http\Controllers\OrderPartnerController;
use App\Http\Controllers\PaidPartnerController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\Partner\ShoppingCartPartner;
use GuzzleHttp\Promise\Create;
use App\Http\Livewire\Partner\CreateOrderPartner;
use App\Models\OrderPartner;



Route::get('/', ShowProducts::class)->name('partner.index');
Route::get('search', SearchController::class)->name('search');
Route::get('shopping-cart-partner', ShoppingCartPartner::class)->name('partner.shopping-cart-partner');




Route::middleware(['auth'])->group(function(){

    Route::get('/', ShowProducts::class)->name('partner.index');


    Route::get('order', [OrderPartnerController::class, 'index'])->name('partner.order.index');

    Route::get('order/create', CreateOrderPartner::class)->name('partner.order.create');

    Route::get('order/{order_partner}/payment', [OrderPartnerController::class,'payment'])->name('orderpartner.payment');

     //IZIPAY

     Route::post('/paid/izipay',[PaidPartnerController::class,'izipay'])->name('paidpartner.izipay');

     Route::get('order_partners/{order_partner}/show', [OrderPartnerController::class,'show'])->name('orderpartners.show');

    });
