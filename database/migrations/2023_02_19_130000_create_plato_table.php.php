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
        Schema::dropIfExists('plato');
        if (!Schema::hasTable('plato')) {
            Schema::create('plato', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('menu_id')->unsigned();
                $table->foreign('menu_id')->references('id')->on('menu');
                $table->string('nombre');
                $table->string('descripcion');
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
        Schema::dropIfExists('plato');
    }
};
