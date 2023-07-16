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
        Schema::create('user_services', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->nullable()->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('id_service')->nullable()->unsigned();
            $table->foreign('id_service')->references('id')->on('servicios');
            $table->tinyInteger('tp_activo')->default(1);
            $table->tinyInteger('tp_respuesta_final')->default(1);
            $table->tinyInteger('tp_derivacion')->default(1);
            $table->tinyInteger('tp_responsable')->default(1);
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
        Schema::dropIfExists('user_services');
    }
};
