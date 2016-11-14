<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreIcfesResutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_icfes_resuts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('math_score')->nullable();
            $table->integer('critical_reading_score')->nullable();
            $table->integer('social_score')->nullable();
            $table->integer('natural_sciences_score')->nullable();
            $table->integer('english_score')->nullable();
            $table->integer('total_score');

            $table->integer('student_id')->unsigned();
            $table->integer('pre_icfes_id')->unsigned();

            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');
            $table->foreign('pre_icfes_id')
                  ->references('id')
                  ->on('pre_icfes')
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
        Schema::drop('pre_icfes_resuts');
    }
}
