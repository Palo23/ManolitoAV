<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos_users', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_curso');
            $table->foreign('ID_curso')->references('ID_curso')->on('cursos');
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('users');
            $table->date('year');
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
        Schema::dropIfExists('cursos_users');
    }
}
