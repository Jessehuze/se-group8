<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupRouteAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_route_access', function (Blueprint $table) {
            $table->integer('groupid')->unsigned()->foreign()
                  ->references('groupid')->on('groups')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('routeid')->unsigned()->foreign()
                  ->references('routeid')->on('route')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['groupid', 'routeid']);
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
        Schema::drop('group_route_access');
    }
}
