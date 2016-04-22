<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function dashboard()
    {
      /*
      //Non Functional ORM Code For Grabbing Data From Database
      $user = Auth::user();
      $routes = User::routes();
      $groups = User::groups();
      $friends = User::friends();
      $ownedGroups = User::ownedGroups();
      $ownedRoutes = User::ownedRoutes();

      //Don't Pass all of these variables as one array like this 
      $userdata = array('user' => $user,
                        'routes' => $routes,
                        'groups' => $groups,
                        'friends' => $friends,
                        'ownedGroups' => $ownedGroups,
                        'ownedRoutes' => $ownedRoutes);
      */
      /*
      //This is an example of using the Object Relational Mapping (ORM) to save a new
      //row in the group table of the database assuming you actually added values to
      //the column variables.

      $group = new Group;
      $group->groupid = "";
      $group->gname = "";
      $group->ownerid = "";
      $group->save();
      */

      //Variables To Pass To The View
      $routes = "routes";
      $groups = "groups";
      $friends = "friends";
      $ownedGroups = "ownedGroups";
      $ownedRoutes = "ownedRoutes";

      // This will route and pass data to the dashboard view
      return view('pages.dashboard', ['routes' => $routes, 
                                      'groups' => $groups,
                                      'friends' => $friends,
                                      'ownedGroups' => $ownedGroups,
                                      'ownedRoutes' => $ownedRoutes]);
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
