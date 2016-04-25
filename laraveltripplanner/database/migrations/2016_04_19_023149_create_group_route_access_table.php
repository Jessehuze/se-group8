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
            $table->integer('group_id')->unsigned()->foreign()
                  ->references('id')->on('groups')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('route_id')->unsigned()->foreign()
                  ->references('id')->on('routes')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['group_id', 'route_id']);
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
