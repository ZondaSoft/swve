<?php

// Multas

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeh011sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veh011s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unidad',5)->nullable();
            $table->string('dominio',7)->nullable();
            $table->date('fecha')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->integer('encarga')->nullable();
            $table->decimal('importe',11,2)->nullable();
            $table->string('detalle',254)->nullable();
            $table->string('estado',40)->nullable();
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
        Schema::dropIfExists('veh011s');
    }
}
