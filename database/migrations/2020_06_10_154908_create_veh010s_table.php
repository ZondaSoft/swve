<?php

// RTO

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeh010sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veh010s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unidad',5)->nullable();
            $table->string('dominio',7)->nullable();
            $table->date('fecha')->nullable();
            $table->integer('encarga')->nullable();
            $table->string('tipo',20)->nullable();
            $table->string('detalle',254)->nullable();
            $table->date('vencimient')->nullable();
            $table->integer('pend_final')->nullable();
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
        Schema::dropIfExists('veh010s');
    }
}
