<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend_list', function (Blueprint $table) {
            $table->string('userid')->foreign()
                  ->references('username')->on('User')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->string('friendid')->foreign()
                  ->references('username')->on('User')
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
        Schema::drop('friend_list');
    }
}
