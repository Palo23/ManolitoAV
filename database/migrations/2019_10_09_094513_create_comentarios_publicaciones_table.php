<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosPublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios_publicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ID_comentario');
            $table->foreign('ID_comentario')->references('id')->on('comentarios');
            $table->unsignedBigInteger('ID_publicacion');
            $table->foreign('ID_publicacion')->references('id')->on('publicaciones');
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
        Schema::dropIfExists('comentarios_publicaciones');
    }
}
