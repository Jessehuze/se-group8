<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_access', function (Blueprint $table) {
            $table->string('userid')->foreign()
                  ->references('username')->on('User')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('routeid')->unsigned()->foreign()
                  ->references('routeid')->on('Route')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->char('modrights', 1);
            $table->primary(['userid', 'routeid']);
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
        Schema::drop('route_access');
    }
}
