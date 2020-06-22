<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGrupoToVeh001 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('veh001s', function (Blueprint $table) {
           $table->integer('grupo')->nullable(); // Campo nuevo

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
      Schema::table('veh001s', function (Blueprint $table) {
           $table->dropColumn('grupo'); // Campo nuevo
      });
    }
}
