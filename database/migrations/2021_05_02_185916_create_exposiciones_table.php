<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExposicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exposiciones', function (Blueprint $table) {
            $table->unsignedInteger('id_posteo')->primary();
            $table->unsignedInteger('id_topico');
            $table->foreign('id_posteo')->references('id')->on('posteos')->onDelete('cascade');
            $table->foreign('id_topico')->references('id')->on('posteos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exposiciones');
    }
}
