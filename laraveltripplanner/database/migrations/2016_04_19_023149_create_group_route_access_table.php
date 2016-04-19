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
            $table->foreign('groupid')
                  ->references('groupid')->on('groups')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('routeid')
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
