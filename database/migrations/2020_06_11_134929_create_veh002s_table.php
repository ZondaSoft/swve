<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeh002sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veh002s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dominio',7)->nullable();
            $table->string('codigo',3)->nullable();
            $table->string('vehiculo',40)->nullable();
            $table->string('detalle',50)->nullable();
            $table->string('domic',30)->nullable();
            $table->string('encargado',30)->nullable();
            $table->string('depos',1)->nullable();
            $table->string('modelo',25)->nullable();
            $table->integer('anio')->nullable();
            $table->string('motor',25)->nullable();
            $table->string('chasis',25)->nullable();
            $table->string('titulo_ori',20)->nullable();
            $table->string('modelo2',10)->nullable();
            $table->string('estado',10)->nullable();
            $table->string('inscripto',20)->nullable();
            $table->integer('numero')->nullable();
            $table->string('municipal',20)->nullable();
            $table->integer('pin')->nullable();
            $table->date('vto_ruta')->nullable();
            $table->date('vto_tecni')->nullable();
            $table->string('n_poliza',25)->nullable();
            $table->date('vto_tarj')->nullable();
            $table->string('ccosto',5)->nullable();
            $table->date('f_alta')->nullable();
            $table->date('f_baja')->nullable();
            $table->string('equipo',20)->nullable();
            $table->string('modelo_eq',25)->nullable();
            $table->integer('anio_eq')->nullable();
            $table->integer('pventa')->nullable();
            $table->integer('grupo')->nullable(); // Campo nuevo
            $table->timestamps();


            // FK
            $table->foreign('grupo')->references('codigo')->on('veh007s');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veh002s');
    }
}
