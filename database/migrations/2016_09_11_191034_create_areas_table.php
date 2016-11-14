<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('weighted_value');
            $table->string('grade');
            $table->timestamps();
        });

        Schema::create('area_pre_icfes', function(Blueprint $table){
            $table->increments('id');
            $table->integer('pre_icfes_id')->unsigned();
            $table->integer('area_id')->unsigned();

            $table->foreign('pre_icfes_id')
                  ->references('id')
                  ->on('pre_icfes')
                  ->onDelete('cascade');

            $table->foreign('area_id')
                  ->references('id')
                  ->on('areas')
                  ->onDelete('cascade');

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
        Schema::drop('area_pre_icfes');
        Schema::drop('areas');
    }
}
