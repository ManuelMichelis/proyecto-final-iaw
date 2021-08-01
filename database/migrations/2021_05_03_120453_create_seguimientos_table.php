<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_seguidor');
            $table->unsignedBigInteger('id_seguido');
            $table->unique(["id_seguidor", "id_seguido"], 'seguidor_seguido_unique');
            $table->foreign('id_seguidor')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_seguido')->references('id')->on('usuarios')->onDelete('cascade');
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
        Schema::dropIfExists('seguimientos');
        //Schema::dropUnique('seguidor_seguido_unique');
    }
}
