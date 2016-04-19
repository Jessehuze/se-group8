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
            $table->foreign('groupid')
                  ->references('groupid')->on('groups')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('userid')
                  ->references('username')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['groupid', 'userid']);
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
