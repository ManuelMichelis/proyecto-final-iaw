<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscripciones', function (Blueprint $table) {
            $table->string('alias_suscripto');
            $table->unsignedInteger('id_topico');
            $table->unique(["alias_suscripto", "id_topico"], 'suscripto_topico_unique');
            $table->foreign('alias_suscripto')->references('alias')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_topico')->references('id')->on('topicos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suscripciones');
        //Schema::dropUnique('suscripto_topico_unique');
    }
}
