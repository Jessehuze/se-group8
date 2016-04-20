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
        Schema::create('Waypoint', function (Blueprint $table) {
            $table->increments('waypointid');
            $table->integer('routeid')->unsigned()->foreign()
                  ->references('routeid')->on('Route')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->float('lat');
            $table->float('lon');
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
        Schema::drop('Waypoint');
    }
}
