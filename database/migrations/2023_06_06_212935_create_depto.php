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
        Schema::create('depto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('nr_unidad')->nullable()->unsigned();
            $table->integer('nr_institucion')->nullable()->unsigned();
            $table->tinyInteger('tp_activo')->default(1);
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
        Schema::dropIfExists('depto');
    }
};
