<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  //Mass Assignment
  protected $fillable = array('gname', 'user_id');

  //Relationships
  public function owner() {
      return $this->belongsTo('App\User');
  }

  public function members() {
      return $this->belongsToMany('App\User', 'group_members', 'group_id', 'user_id');
  }

  public function routes() {
      return $this->belongsToMany('App\Route', 'group_route_access', 'group_id', 'route_id');
  }
}
