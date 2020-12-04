<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePerbandinganKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('perbandingan_kriteria');
        Schema::create('perbandingan_kriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('kriteria1_id')->unsigned();
            $table->unsignedBigInteger('kriteria2_id')->unsigned();
            $table->unsignedBigInteger('daerah_id')->unsigned();
            $table->double('nilai');
            $table->timestamps();
            //$table->foreign('nilai_id')->references('id')->on('nilai');
            $table->foreign('kriteria1_id')->references('id')->on('kriteria');
            $table->foreign('kriteria2_id')->references('id')->on('kriteria');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('perbandingan_kriteria');
    }
}
