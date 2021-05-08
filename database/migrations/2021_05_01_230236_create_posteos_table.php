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
            $table->string('titulo')->nullable();
            $table->string('contenido')->nullable(false);
            $table->unsignedInteger('votos')->default(0);
            $table->string('alias_usuario');
            $table->foreign('alias_usuario')->references('alias')->on('usuarios')->onDelete('cascade');
            $table->unsignedInteger('id_referido')->nullable();
            $table->foreign('id_referido')->references('id')->on('posteos')->onDelete('cascade');
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
