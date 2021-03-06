<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('motivo');
            $table->string('detalle');
            $table->unsignedInteger('id_denunciado');
            $table->foreign('id_denunciado')->references('id')->on('posteos')->onDelete('cascade');
            $table->string('alias_bloqueado');
            $table->foreign('alias_bloqueado')->references('alias')->on('usuarios')->onDelete('cascade');
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
        Schema::dropIfExists('denuncias');
    }
}
