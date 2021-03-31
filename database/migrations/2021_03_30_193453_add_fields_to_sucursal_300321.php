<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSucursal300321 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sucursals', function (Blueprint $table) {
            //
            $table->string("ip",20)->nullable();
            $table->string("usuario","20")->nullable();
            $table->string("clave",20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sucursals', function (Blueprint $table) {
            //
            $table->dropColumn("ip");
            $table->dropColumn("usuario");
            $table->dropColumn("clave");
        });
    }
}
