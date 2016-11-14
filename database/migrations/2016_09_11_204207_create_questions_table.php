<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');

            $table->integer('author_id')->unsigned();
            $table->integer('asignature_id')->unsigned();
            $table->integer('competence_id')->unsigned();


            $table->foreign('author_id')
                  ->references('id')
                  ->on('authors')
                  ->onDelete('cascade');
            $table->foreign('asignature_id')
                  ->references('id')
                  ->on('asignatures')
                  ->onDelete('cascade');
            $table->foreign('competence_id')
                  ->references('id')
                  ->on('competences')
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
        Schema::drop('questions');
    }
}
