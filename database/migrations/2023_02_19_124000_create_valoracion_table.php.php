<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('valoracion');
        if (!Schema::hasTable('valoracion')) {
            Schema::create('valoracion', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('usuario_id')->unsigned();
                $table->foreign('usuario_id')->references('id')->on('users');
                $table->bigInteger('menu_id')->unsigned();
                $table->foreign('menu_id')->references('id')->on('menu');
                $table->integer('puntuacion');
                $table->string('comentario');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valoracion');
    }
};
