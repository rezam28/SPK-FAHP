<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbandinganAlternatifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('perbandingan_alternatif');
        Schema::create('perbandingan_alternatif', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('nama_kriteria')->unsigned();
            $table->unsignedBigInteger('daerah_id')->unsigned();
            $table->unsignedBigInteger('alternatif1_id')->unsigned();
            $table->unsignedBigInteger('alternatif2_id')->unsigned();
            $table->double('nilai');
            $table->timestamps();
            $table->foreign('nama_kriteria')->references('id')->on('kriteria');
            $table->foreign('daerah_id')->references('id')->on('daerah');
            $table->foreign('alternatif1_id')->references('id')->on('alternatif');
            $table->foreign('alternatif2_id')->references('id')->on('alternatif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('perbandingan_alternatif');
    }
}
