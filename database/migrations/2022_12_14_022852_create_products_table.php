<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku');
            $table->json('bodega');
            $table->integer('stock_flex')->nullable();
            $table->json('bodega')->default(json_encode([
                '03-LIM-JOCKEYPZ-MIST' => null,
                '03-LIM-ATOCONG-MISTR' => null,
                'campo3' => null,
                'campo4' => null,
                'campo5' => null,
                'campo6' => null,
                'campo7' => null,
                'campo8' => null,
                'campo9' => null,
                'campo10' => null,
            ]))->change();

            $table->string('slug');
            $table->text('description');
            $table->float('price');
            $table->float('price_tachado');
            $table->float('price_partner');

            $table->unsignedBigInteger('subcategory_id');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->integer('quantity')->nullable();
            $table->integer('quantity_partner')->nullable();

            $table->enum('status',[Product::BORRADOR, Product::PUBLICADO])->default(Product::BORRADOR);

            $table->enum('destacado',[Product::NODESTACADO, Product::DESTACADO])->default(Product::NODESTACADO);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
