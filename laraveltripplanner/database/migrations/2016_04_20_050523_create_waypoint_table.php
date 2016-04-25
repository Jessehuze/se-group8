<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaypointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waypoints', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('routeid')->unsigned()->foreign()
                  ->references('id')->on('routes')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('index');
            $table->string('addr');
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
        Schema::drop('waypoints');
    }
}
