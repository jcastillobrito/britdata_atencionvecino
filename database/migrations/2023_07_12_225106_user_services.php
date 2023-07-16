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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->integer('nr_institucion')->nullable()->unsigned();
            $table->foreign('nr_institucion')->references('id')->on('institucion');
            $table->tinyInteger('tp_activo')->default(1);
            $table->integer('id_unidad')->nullable();
            $table->integer('id_depto')->nullable();
            $table->tinyInteger('tp_resp_automatica')->default(0);
            $table->tinyInteger('tp_visto_bueno_jefatura')->default(0);
            $table->text('resp_automatica')->nullable();
            $table->tinyInteger('nr_dias_plazo')->nullable();
            $table->text('descripcion_servicio')->nullable();
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
        Schema::dropIfExists('services');
        
    }
};
