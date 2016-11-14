<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentPreIcfesQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_pre_icfes_questions', function(Blueprint $table){
            $table->increments('id');
            $table->string('answer');

            $table->integer('question_id')->unsigned();
            $table->integer('pre_icfes_id')->unsigned();
            $table->integer('student_id')->unsigned();
            
            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');
            $table->foreign('question_id')
                  ->references('id')
                  ->on('questions')
                  ->onDelete('cascade');
            $table->foreign('pre_icfes_id')
                  ->references('id')
                  ->on('pre_icfes')
                  ->onDelete('cascade');
        });

        Schema::table('student_pre_icfes_questions', function ($table) {
            $table->dropColumn('answer');
            
            $table->integer('option_id')->unsigned();
            $table->foreign('option_id')
                  ->references('id')
                  ->on('question_options')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('student_pre_icfes_questions');
    }
}
