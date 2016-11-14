<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreIcfesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_icfes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamp('start_date');
            $table->enum('state', ['pendiente', 'en curso', 'finalizado']);
            $table->integer('class_room_id')->unsigned();
            $table->foreign('class_room_id')
                  ->references('id')
                  ->on('class_rooms')
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
        Schema::drop('pre_icfes');
    }
}
