<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_members', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->foreign()
                  ->references('id')->on('groups')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->string('user_id')->foreign()
                  ->references('id')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['group_id', 'user_id']);
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
        Schema::drop('group_members');
    }
}
