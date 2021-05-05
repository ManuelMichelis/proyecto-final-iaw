<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosteosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posteos', function (Blueprint $table) {
            $table->id();
            $table->string('contenido');
            $table->unsignedInteger('votos');
            $table->string('alias_usuario');
            $table->foreign('alias_usuario')->references('alias')->on('usuarios')->onDelete('cascade');
            $table->unsignedInteger('id_referido')->nullable();
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
        Schema::dropIfExists('posteos');
    }
}
