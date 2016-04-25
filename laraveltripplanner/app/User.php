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

    // Old Relations That Need To Be Reworked

    //Relationships
    
    public function friends() {
        return $this->belongsToMany('App\User', 'friend_list', 'user_id', 'friend_id');
    }
    
    public function friendTo() {
        return $this->belongsToMany('App\User', 'friend_list', 'friend_id', 'user_id');
    }
    
    public function groups() {
        return $this->belongsToMany('App\Group', 'group_members', 'user_id', 'group_id');
    }
    
    public function ownedGroups() {
        return $this->hasMany('App\Group');
    }
    
    public function ownedRoutes() {
        return $this->hasMany('App\Route');
    }
    
    public function routes() {
        return $this->belongsToMany('App\Route', 'route_access', 'user_id', 'route_id');
    }
}
?>
