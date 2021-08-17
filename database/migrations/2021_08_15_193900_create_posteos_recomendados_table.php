<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosteosRecomendadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posteos_recomendados', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_posteo');
            $table->unsignedFloat('valor_recomendacion');
            $table->unique(["id_usuario", "id_posteo"], 'usuario_posteo_recomendado_unique');
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_posteo')->references('id')->on('posteos')->onDelete('cascade');
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
        Schema::dropIfExists('posteos_recomendados');
    }
}
