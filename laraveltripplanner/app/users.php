<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $primaryKey = 'username';

    //Mass Assignment
    protected $fillable = array('username', 'usr_pass', 'fname', 'lname');

    //Relationships
    public function friends() {
        return $this->belongsToMany('users', 'friends', 'userid', 'friendid');
    }

    public function groups() {
        return $this->belongsToMany('groups', 'group_members', 'groupid', 'userid');
    }

    public function routesOwned() {
        return $this->hasMany('routes')
    }
}
