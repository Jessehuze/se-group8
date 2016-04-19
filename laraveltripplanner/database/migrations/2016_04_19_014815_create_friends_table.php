<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->string('userid')->foreign()
                  ->references('username')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->string('friendid')->foreign()
                  ->references('username')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade')->onUpdate('cascade');
            $table->primary(['userid', 'friendid']);

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
        Schema::drop('friends');
    }
}
