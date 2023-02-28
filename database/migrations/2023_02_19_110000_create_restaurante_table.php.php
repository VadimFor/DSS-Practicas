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
        Schema::dropIfExists('restaurante');
        if (!Schema::hasTable('restaurante')) {
            Schema::create('restaurante', function (Blueprint $table) {
                $table->id();
                $table->string('nombre')->unique();
                $table->string('direccion');
                $table->integer('telefono')->nullable();
                $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('restaurante');
    }
};
