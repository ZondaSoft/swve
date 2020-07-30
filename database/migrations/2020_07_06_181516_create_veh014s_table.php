<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeh014sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veh014s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unidad',5)->nullable();
            $table->string('dominio',7)->nullable();
            $table->string('periodo',7)->nullable();
            $table->date('fecha')->nullable();
            $table->decimal('importe',12,2)->nullable();
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
        Schema::dropIfExists('veh014s');
    }
}
