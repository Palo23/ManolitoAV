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
            $table->bigIncrements('idArchivoPublicacion');
            $table->unsignedBigInteger('ID_archivo');
            $table->foreign('ID_archivo')->references('ID_archivo')->on('archivos');
            $table->unsignedBigInteger('ID_publicacion');
            $table->foreign('ID_publicacion')->references('ID_publicacion')->on('publicaciones');
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
