<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableDaerah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daerah', function (Blueprint $table)
        {
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daerah', function(Blueprint $table){
            $table->dropColumn('lat');
            $table->dropColumn('lng');
        });
    }
}
