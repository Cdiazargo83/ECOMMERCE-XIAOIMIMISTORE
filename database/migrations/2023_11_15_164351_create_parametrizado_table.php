<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrizadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametrizado', function (Blueprint $table) {
            $table->id();

            $table->string('canal')->nullable();
            $table->string('desc_canal')->nullable();
            $table->string('subcanal')->nullable();
            $table->string('desc_subcanal')->nullable();
            $table->string('modelo_negocio')->nullable();
            $table->string('bodega')->nullable();
            $table->string('tipo_distribucion')->nullable();
            $table->string('lp_visual')->nullable();
            $table->string('desc_lp_visual')->nullable();
            $table->string('lp_neto')->nullable();
            $table->string('desc_lp_neto')->nullable();


            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_id')->references('id')->on('empresa_canal');

            $table->unsignedBigInteger('desc_empresa_id')->nullable();
            $table->foreign('desc_empresa_id')->references('id')->on('empresa_canal');

            $table->unsignedBigInteger('canal_id')->nullable();
            $table->foreign('canal_id')->references('id')->on('canal_subcanal');

            $table->unsignedBigInteger('desc_canal_id')->nullable();
            $table->foreign('desc_canal_id')->references('id')->on('canal_subcanal');

            $table->unsignedBigInteger('subcanal_id')->nullable();
            $table->foreign('subcanal_id')->references('id')->on('canal_subcanal');

            $table->unsignedBigInteger('desc_subcanal_id')->nullable();
            $table->foreign('desc_subcanal_id')->references('id')->on('canal_subcanal');

            $table->unsignedBigInteger('modelo_negocio_id')->nullable();
            $table->foreign('modelo_negocio_id')->references('id')->on('canal_subcanal');

            $table->unsignedBigInteger('bodega_id')->nullable();
            $table->foreign('bodega_id')->references('id')->on('canal_subcanal');

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
        Schema::dropIfExists('parametrizado');
    }
}
