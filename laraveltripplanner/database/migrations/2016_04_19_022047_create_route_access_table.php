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
            $table->foreign('userid')
                  ->references('username')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('routeid')
                  ->references('routeid')->on('route')
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
