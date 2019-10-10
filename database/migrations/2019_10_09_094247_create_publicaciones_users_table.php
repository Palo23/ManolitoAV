<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones_users', function (Blueprint $table) {
            $table->bigIncrements('idPubUser');
            $table->integer('id')->unsigned();
            $table->foreign('id')->references('id')->on('users');
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
        Schema::dropIfExists('publicaciones_users');
    }
}
