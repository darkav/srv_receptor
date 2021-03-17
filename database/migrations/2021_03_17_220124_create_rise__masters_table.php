<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiseMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('rise__masters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sucursal_id')->constrained();
            $table->string('tabla', 50)->index();
            $table->string('clave', 50)->index();
            $table->json('registro');
            $table->enum('upload_status', ["pendiente","subido","fallo"]);
            $table->enum('syspro_status', ["pendiente","procesado","fallo"]);
            $table->longText('syspro_mensaje');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rise__masters');
    }
}
