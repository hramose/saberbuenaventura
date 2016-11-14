<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->enum('type_document', ['tarjeta de identidad', 'cedula de ciudadania']);
            $table->string('number_documnet')->unique();
            $table->enum('sex', ['hombre', 'mujer']);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->date('birthday');
            $table->enum('state', ['activo', 'inactivo']);

            $table->integer('class_room_id')->unsigned();
            $table->foreign('class_room_id')
                  ->references('id')
                  ->on('class_rooms')
                  ->onDelete('cascade');

            $table->rememberToken();
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
        Schema::drop('students');
    }
}
