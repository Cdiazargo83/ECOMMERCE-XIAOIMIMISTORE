<?php


use App\Http\Controllers\Facturacion\RegisterController;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::post('register', [RegisterController::class, 'store'])->name('admin.facturacion.register.store');


