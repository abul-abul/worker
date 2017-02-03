<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFildRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rate', function(Blueprint $table)
        {
            $table->integer('vole1');
            $table->integer('vole2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rate', function(Blueprint $table)
        {
            $table->dropColumn(['vole1']);
            $table->dropColumn(['vole2']);
        });
    }


}
