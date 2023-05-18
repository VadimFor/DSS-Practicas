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
        Schema::dropIfExists('menu');
        if (!Schema::hasTable('menu')) {
            Schema::create('menu', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->string('descripcion')->nullable();
                $table->integer('precio');
                $table->bigInteger('restaurante_id')->unsigned();
                $table->foreign('restaurante_id')->references('id')->on('restaurante')->onDelete('cascade');
                $table->string('img')->nullable();
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
        Schema::dropIfExists('menu');
    }
};
