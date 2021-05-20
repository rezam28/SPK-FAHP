<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('daerah_id')->unsigned();
            $table->text('keterangan');
            $table->timestamps();
            $table->foreign('daerah_id')->references('id')->on('daerah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peta');
    }
}
