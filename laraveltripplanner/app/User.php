<?php
namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* Old Relations That Need To Be Reworked

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
    */
}
?>
