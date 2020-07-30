<?php

// Inicio venta

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeh025sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veh025s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dominio',7)->nullable();
            $table->string('codigo',3)->nullable();
            $table->date('fecha')->nullable();
            $table->string('tipo_baja',40)->nullable();
            $table->string('detalle',254)->nullable();
            $table->string('estado',40)->nullable();
            $table->date('fecha_baja')->nullable();
            $table->string('detalle_baja',254)->nullable();
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
        Schema::dropIfExists('veh025s');
    }
}
