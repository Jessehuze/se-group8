<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\User;

use App\Route;

use App\Group;

use Illuminate\Support\Facades\Redirect;

class PagesController extends Controller
{
    public function dashboard()
    {
      $user = Auth::user();

      //Functional ORM Code For Grabbing Data From Database
      if (Auth::check()) {
        $routes = $user->routes()->get();
        $groups = Group::all();
        $users = User::all();
        $friends = $user->friends()->get();
        $userGroups = $user->groups()->get();
        $ownedGroups = $user->ownedGroups()->get();
        $ownedRoutes = $user->ownedRoutes()->get();

        $friendIds = array(); 
        foreach($friends as $friend) {
          array_push($friendIds, $friend->id);
        }

        $groupIds = array();
        foreach($userGroups as $group) {
          array_push($groupIds, $group->id);
        }
      }
      else {
        $routes = $groups = $users = $friends = null;
        $ownedGroups = $ownedRoutes = $friendIds = null;
        $groupIds = null;
      }

      // This will route and pass data to the dashboard view
      return view('pages.dashboard', ['user' => $user,
                                      'users' => $users,
                                      'routes' => $routes, 
                                      'groups' => $groups,
                                      'friends' => $friends,
                                      'friendIds' => $friendIds, //The IDs of Logged in user's friends
                                      'groupIds' => $groupIds, //The IDs of Logged in user's groups
                                      'ownedGroups' => $ownedGroups,
                                      'ownedRoutes' => $ownedRoutes]);
    }

    public function createRoute(Request $request)
    {
      $user = Auth::user();

      $route = new Route;
      $route->rname = $request->input('rname');
      $route->user_id = $user->id;
      $route->save();

      return Redirect::action('PagesController@dashboard');
    }

    public function createGroup(Request $request)
    {
      $user = Auth::user();

      $group = new Group;
      $group->gname = $request->input('gname');
      $group->user_id = $user->id;
      $group->save();
      $group->members()->attach(array($user->id)); //Adds user as member of group

      return Redirect::action('PagesController@dashboard');
    }

    public function joinGroup(Request $request)
    {
      $user = Auth::user();
      $groupId = $request->input('group_id');
      $user->groups()->attach($groupId);

      return Redirect::action('PagesController@dashboard');
    }

    public function leaveGroup(Request $request)
    {
      $user = Auth::user();
      $groupId = $request->input('group_id');
      $user->groups()->detach($groupId);

      return Redirect::action('PagesController@dashboard');
    }

    public function addFriend(Request $request)
    {
      $user = Auth::user();
      $user->friends()->attach(array($request->input('user_id')));

      return Redirect::action('PagesController@dashboard');
    }

    public function removeFriend(Request $request)
    {
      $user = Auth::user();
      $friendId = $request->input('user_id');
      $user->friends()->detach($friendId);

      return Redirect::action('PagesController@dashboard');
    }

    public function example()
    {
      return view('pages.example');
    }

    public function login()
    {
      return view('pages.login');
    }

    public function signup()
    {
      return view('pages.signup');
    }
}
