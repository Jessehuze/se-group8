<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'username';

    //Mass Assignment
    protected $fillable = array('username', 'usr_pass', 'fname', 'lname');

    //Relationships
    public function friends() {
        return $this->belongsToMany('User', 'friend_list', 'userid', 'friendid');
    }

    public function friendTo() {
        return $this->belongsToMany('User', 'friend_list', 'friendid', 'userid');
    }

    public function groups() {
        return $this->belongsToMany('Group', 'group_members', 'userid', 'groupid');
    }

    public function ownedGroups() {
        return $this->hasMany('Group');
    }

    public function ownedRoutes() {
        return $this->hasMany('Route');
    }

    public function routes() {
        return $this->belongsToMany('Route', 'route_access', 'userid', 'routid');
    }
}
