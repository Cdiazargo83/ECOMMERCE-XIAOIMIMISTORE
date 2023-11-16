<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaisMonedaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pais_moneda', function (Blueprint $table) {
            $table->id();
            $table->string('pais');
            $table->string('desc_pais');
            $table->enum('moneda',["PEN","USD"]);
            $table->string('desc_moneda');
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
        Schema::dropIfExists('pais_moneda');
    }
}
