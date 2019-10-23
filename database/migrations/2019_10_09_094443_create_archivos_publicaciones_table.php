<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosPublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos_publicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ID_archivo');
            $table->foreign('ID_archivo')->references('id')->on('archivos');
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
        Schema::dropIfExists('archivos_publicaciones');
    }
}
