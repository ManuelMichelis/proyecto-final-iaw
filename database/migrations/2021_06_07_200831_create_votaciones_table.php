<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votaciones', function (Blueprint $table) {
            $table->string('alias_votante');
            $table->unsignedInteger('id_posteo');
            $table->unique(["alias_votante", "id_posteo"], 'votante_posteo_unique');
            $table->foreign('alias_votante')->references('alias')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_posteo')->references('id')->on('posteos')->onDelete('cascade');
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
        Schema::dropIfExists('votaciones');
        //Schema::dropUnique('votante_posteo_unique');
    }
}
