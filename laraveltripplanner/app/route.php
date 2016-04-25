<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
 
    //Mass Assignment
    protected $fillable = array('rname', 'user_id');

    //Relationships
    public function owner() {
        return $this->belongsTo('User', 'User');
    }

    public function users() {
        return $this->belongsToMany('User', 'route_access', 'routeid', 'userid');
    }

    public function groups() {
        return $this->belongsToMany('Group', 'group_route_access', 'routeid', 'groupid');
    }

    public function waypoints() {
        return $this->hasMany('Waypoint');
    }
}
