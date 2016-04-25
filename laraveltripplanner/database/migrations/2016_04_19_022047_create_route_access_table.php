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
            $table->string('user_id')->foreign()
                  ->references('id')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('route_id')->unsigned()->foreign()
                  ->references('id')->on('routes')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->char('modrights', 1);
            $table->primary(['user_id', 'route_id']);
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
