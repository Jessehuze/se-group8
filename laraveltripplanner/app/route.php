<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    //Mass Assignment
    protected $fillable = array('rname', 'user_id');

    //Relationships
    public function owner() {
        return $this->belongsTo('App/User');
    }

    public function users() {
        return $this->belongsToMany('App/User', 'route_access', 'routeid', 'userid');
    }

    public function groups() {
        return $this->belongsToMany('App/Group', 'group_route_access', 'routeid', 'groupid');
    }

    public function waypoints() {
        return $this->hasMany('App/Waypoint');
    }
}
