<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",100)->default("servicio");
            $table->boolean("live")->default(true);
            $table->boolean("push_event")->default(false);
            $table->integer("tiempo_rastreo")->default(2);
            $table->integer("timeout_rastreo")->default(2);
            $table->integer("tiempo_ping")->default(30);
            $table->integer("timeout_ping")->default(30);
            $table->boolean("enviar_correo")->default(false);
            $table->string("correos",255)->nullable();
            $table->string("estado",3)->default("IDL");
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
        Schema::dropIfExists('servicios');
    }
}
