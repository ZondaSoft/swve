<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeh015sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veh015s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unidad',5)->nullable();
            $table->string('dominio',7)->nullable();
            $table->date('fecha')->nullable();
            $table->integer('encarga')->nullable();
            $table->integer('nro_siniestro')->nullable();
            $table->string('cia',60)->nullable();
            $table->string('estado',40)->nullable();
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
        Schema::dropIfExists('veh015s');
    }
}
