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
            $table->string('user_id')->foreign()
                  ->references('id')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->string('friend_id')->foreign()
                  ->references('id')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['user_id', 'friend_id']);

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
