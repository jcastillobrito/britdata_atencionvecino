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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('ap_paterno');
            $table->string('ap_materno');
            $table->string('nr_rut',20)->unique();
            $table->string('id_externo')->nullable();
            $table->string('email')->unique();
            $table->string('celular')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('nr_institucion')->nullable()->unsigned();
            $table->dateTime('last_login')->nullable();
            //crea clave foranea con la tabla instituciones
            $table->foreign('nr_institucion')->references('id')->on('institucion');
            //Infraestructura municipal
            $table->integer('nr_unidad')->nullable()->unsigned();
            $table->integer('nr_depto')->nullable()->unsigned();
            $table->integer('nr_seccion')->nullable()->unsigned();
            
            $table->tinyInteger('tp_activo')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
