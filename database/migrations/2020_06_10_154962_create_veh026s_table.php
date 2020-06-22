<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeh026sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veh026s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dominio',7)->nullable();
            $table->string('codigo',3)->nullable();
            $table->integer('tramite')->nullable();   // 1-Libre deuda de multas  2-Libre deuda patentes   3-Informe de dominio  4-Denuncia de venta   5-Verificación policial    6-Formulario CETA
            $table->date('fecha')->nullable();
            $table->string('detalle',254)->nullable();
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
        Schema::dropIfExists('veh026s');
    }
}
