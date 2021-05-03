<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicosPosteosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topicos_posteos', function (Blueprint $table) {
            $table->unsignedInteger('id_posteo');
            $table->unsignedInteger('id_topico');
            $table->foreign('id_posteo')->references('id')->on('posteos')->onDelete('cascade');
            $table->foreign('id_topico')->references('id')->on('posteos')->onDelete('cascade');
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
        Schema::dropIfExists('topicos_posteos');
    }
}
