<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosPublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_publicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cursos_id')->unsigned();
            $table->foreign('cursos_id')->references('id')->on('cursos');
            $table->unsignedBigInteger('publicaciones_id');
            $table->foreign('publicaciones_id')->references('id')->on('publicaciones');
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
        Schema::dropIfExists('cursos_publicaciones');
    }
}
