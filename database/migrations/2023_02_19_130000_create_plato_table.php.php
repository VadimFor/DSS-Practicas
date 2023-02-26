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
        Schema::create('plato', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('menu_id')->unsigned();
            $table->foreignId('menu_id')->constrained();
            $table->string('nombre');
            $table->string('descripcion');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plato');
    }
};
