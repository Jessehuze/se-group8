<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  //Mass Assignment
  protected $fillable = array('gname', 'user_id');

  //Relationships
  public function owner() {
      return $this->belongsTo('User');
  }

  public function members() {
      return $this->belongsToMany('User', 'group_members', 'groupid', 'userid');
  }

  public function routes() {
      return $this->belongsToMany('Route', 'group_route_access', 'groupid', 'routeid');
  }
}
