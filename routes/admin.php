<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Livewire\Admin\ShowProducts;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\CreateProduct;
use App\Http\Livewire\Admin\EditProduct;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Livewire\Admin\ShowCategory;
use App\Http\Livewire\Admin\BrandComponent;
use App\Http\Livewire\Admin\DepartmentComponent;
use App\Http\Livewire\Admin\StatusOrder;
use App\Http\Livewire\Admin\ShowDepartment;
use App\Http\Livewire\Admin\UserComponent;
use App\Http\Controllers\Admin\PromocionController;

use App\Http\Livewire\Admin\ShowBanner;
use App\Http\Livewire\Admin\ShowPromocion;
use App\Http\Controllers\Admin\ProductflexController;
use App\Http\Controllers\Admin\ConsultaPrecioController;


//ruta para PDF

Route::get('orders/{order}/pdf',[OrderController::class, 'pdf'])->name('admin.orders.pdf');


//ruta vista de productos
Route::get('/',ShowProducts::class)->name('admin.index');
Route::get('product/flexproduct', [ShowProducts::class, 'flexproduct'])->name('livewire.admin.show-products');

Route::get('products/create', CreateProduct::class)->name('admin.products.create');
Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');
Route::post('products/{product}/files', [ProductController::class, 'files'])->name('admin.products.files');

Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('categories/{category}', ShowCategory::class)->name('admin.categories.show');

Route::get('brands', BrandComponent::class)->name('admin.brands.index');

Route::get('orders',[OrderController::class, 'index'])->name('admin.orders.index');
Route::get('orders/{order}',[OrderController::class, 'show'])->name('admin.orders.show');

Route::post('orders/{order}/files',[StatusOrder::class, 'files'])->name('admin.orders.files');


Route::get('departments', DepartmentComponent::class)->name('admin.departments.index');
Route::get('departments/{department}', ShowDepartment::class)->name('admin.departments.show');

Route::get('users', UserComponent::class)->name('admin.users.index');


Route::get('banners', [BannerController::class, 'index'])->name('admin.banners.index');
Route::get('banners/{banner}', ShowBanner::class)->name('admin.banners.show');

Route::get('promocions', [PromocionController::class, 'index'])->name('admin.promocions.index');
Route::get('promocions/{promocion}', ShowPromocion::class)->name('admin.promocions.show');



//Route::get('/consulta-productos', [ProductflexController::class, 'consultaProductosView'])->name('admin.consulta-productos');


Route::middleware(['auth'])->group(function () {
    // Otras rutas de administración

    // Ruta para consultar productos usando el método POST
    //Route::get('/consulta-productos', [ProductflexController::class, 'consultaProductos'])->name('livewire.admin.consulta-productos');

    //Route::post('/consulta-productos', [ProductflexController::class, 'consultaProductos'])->name('livewire.admin.consulta-productos');
    Route::match(['get', 'post'], '/consulta-productos', [ProductflexController::class, 'consultaProductos'])->name('livewire.admin.consulta-productos');

    Route::match(['get', 'post'], '/consulta-precio', [ConsultaPrecioController::class, 'consultaPrecio'])->name('livewire.admin.consulta-precio');


    //Route::get('/consulta-productosview', [ProductflexController::class, 'consultaProductosView'])->name('livewire.admin.consultaproductosview');
});



