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
            $table->unsignedBigInteger('id_suscripto');
            $table->unsignedInteger('id_topico');
            $table->unique(["id_suscripto", "id_topico"], 'usuario_topico_unique');
            $table->foreign('id_suscripto')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_topico')->references('id')->on('topicos')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
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
