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
                $table->bigInteger('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('user');
                $table->bigInteger('menu_id')->unsigned();
                $table->foreign('menu_id')->references('id')->on('menu');
                $table->integer('puntuacion');
                $table->string('comentario')->nullable();
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
