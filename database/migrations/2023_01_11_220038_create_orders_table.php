<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Order;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('contact');
            $table->string('dni');

            $table->string('courrier')->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('guia_remision')->nullable();

            $table->float('alto_paquete')->nullable();
            $table->float('ancho_paquete')->nullable();
            $table->float('largo_paquete')->nullable();
            $table->float('peso_paquete')->nullable();
            $table->string('observacion')->nullable();

            $table->string('phone',9);

            $table->enum('status', [Order::RESERVADO,Order::PAGADO, Order::DESPACHADO, Order::ENTREGADO, Order::ANULADO])->default(Order::RESERVADO);
            $table->enum('envio_type', [1, 2]);

            $table->string('atocong');
            $table->string('jockeypz');
            $table->string('megaplz');
            $table->string('huaylas');
            $table->string('puruchu');








            $table->float('shipping_cost');

            $table->float('total');

            $table->json('content');

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');

            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');

            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');

            $table->string('address')->nullable();
            $table->string('references')->nullable();

            $table->json('envio')->nullable();

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
        Schema::dropIfExists('orders');
    }
}




