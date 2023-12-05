<?php

use App\Http\Controllers\Admin\AdministrationController;
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
use App\Http\Controllers\Admin\InyectaDocumentoController;
use App\Http\Controllers\facturacion\DatosController;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Facturacion\RegisterController;
use App\Http\Livewire\Admin\CanalSubcanal;
use App\Http\Livewire\Admin\PaisMoneda;
use App\Http\Livewire\Admin\EmpresaCanal;
use App\Http\Livewire\Admin\Parametrizacion;
use App\Http\Livewire\NuevaVistaController;

//Adminstrador

Route::get('administraciones', [AdministrationController::class, 'index'])->name('admin.administraciones.index');
Route::get('administrar/paismoneda', PaisMoneda::class)->name('livewire.admin.pais-moneda');

Route::get('administrar/empresacanal', EmpresaCanal::class)->name('livewire.admin.empresa-canal');
Route::post('administrar/{logo_path}/files', [EmpresaCanal::class, 'files'])->name('admin.products.files');

Route::get('administrar/canalsubcanal', CanalSubcanal::class)->name('livewire.admin.canal-subcanal');
Route::get('administrar/parametrizacion', Parametrizacion::class)->name('livewire.admin.parametrizacion');

//Route::get('/plataforma_saco/{name_modelo}', [NuevaVistaController::class, 'index'])->name('nueva_vista');
// Ruta para la nueva vista
Route::get('/plataforma_saco/{name_modelo}', \App\Http\Livewire\Admin\NuevaVistaController::class)->name('nueva_vista');

//ruta para PDF

Route::get('orders/{order}/pdf', [OrderController::class, 'pdf'])->name('admin.orders.pdf');

Route::get('users', UserComponent::class)->name('admin.users.index');

//ruta vista de productos
Route::get('/', ShowProducts::class)->name('admin.index');
Route::get('product/flexproduct', [ShowProducts::class, 'flexproduct'])->name('livewire.admin.show-products');

Route::get('products/create', CreateProduct::class)->name('admin.products.create');
Route::get('products/{product}/edit', EditProduct::class)->name('admin.products.edit');
Route::post('products/{product}/files', [ProductController::class, 'files'])->name('admin.products.files');

Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('categories/{category}', ShowCategory::class)->name('admin.categories.show');

Route::get('brands', BrandComponent::class)->name('admin.brands.index');

Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

Route::post('orders/{order}/files', [StatusOrder::class, 'files'])->name('admin.orders.files');


Route::get('departments', DepartmentComponent::class)->name('admin.departments.index');
Route::get('departments/{department}', ShowDepartment::class)->name('admin.departments.show');


Route::get('banners', [BannerController::class, 'index'])->name('admin.banners.index');
Route::get('banners/{banner}', ShowBanner::class)->name('admin.banners.show');

Route::get('promocions', [PromocionController::class, 'index'])->name('admin.promocions.index');
Route::get('promocions/{promocion}', ShowPromocion::class)->name('admin.promocions.show');

//Invoice
Route::get('Invoice', function () {
    $company = Company::first();

    return Storage::get($company->logo_path);
});


Route::middleware(['auth'])->group(function () {

    //CONSULTA FLEXLINE
    Route::match(['get', 'post'], '/consulta-productos', [ProductflexController::class, 'consultaProductos'])->name('livewire.admin.consulta-productos');
    Route::match(['get', 'post'], '/consulta-precio', [ConsultaPrecioController::class, 'consultaPrecio'])->name('livewire.admin.consulta-precio');
});
