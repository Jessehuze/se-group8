<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waypoint extends Model
{
    //Mass Assignment
    protected $fillable = array('route_id', 'index', 'addr');

    //Relationships
    public function route() {
        return $this->belongsTo('App/Route');
    }
}
