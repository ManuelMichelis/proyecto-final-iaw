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
            $table->string('alias_seguidor');
            $table->string('alias_seguido');
            $table->unique(["alias_seguidor", "alias_seguido"], 'seguidor_seguido_unique');
            $table->foreign('alias_seguidor')->references('alias')->on('usuarios')->onDelete('cascade');
            $table->foreign('alias_seguido')->references('alias')->on('usuarios')->onDelete('cascade');
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
        Schema::dropIfExists('seguimientos');
        //Schema::dropUnique('seguidor_seguido_unique');
    }
}
