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
        //$groups = $user->groups()->get();
        $groups = Group::all();
        $friends = $user->friends()->get();
        $ownedGroups = $user->ownedGroups()->get();
        $ownedRoutes = $user->ownedRoutes()->get();
      }
      else {
        $routes = null;
        $groups = null;
        $friends = null;
        $ownedGroups = null;
        $ownedRoutes = null;
      }

      // This will route and pass data to the dashboard view
      return view('pages.dashboard', ['user' => $user, 
                                      'routes' => $routes, 
                                      'groups' => $groups,
                                      'friends' => $friends,
                                      'ownedGroups' => $ownedGroups,
                                      'ownedRoutes' => $ownedRoutes]);
    }

    public function createGroup(Request $request)
    {
      $user = Auth::user();
      $group = new Group;
      //dd($request->input('gname'));
      $group->gname = $request->input('gname');
      $group->user_id = $user->id;
      $group->save();

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
