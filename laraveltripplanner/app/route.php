<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    //Mass Assignment
    protected $fillable = array('rname', 'user_id');

    //Relationships
    public function owner() {
        return $this->belongsTo('App\User');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'route_access', 'route_id', 'user_id');
    }

    public function groups() {
        return $this->belongsToMany('App\Group', 'group_route_access', 'route_id', 'group_id');
    }

    public function waypoints() {
        return $this->hasMany('App\Waypoint');
    }
}
