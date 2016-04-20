<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function dashboard()
    {
      /*
      $user = Auth::user();
      $routes = User::routes();
      $groups = User::groups();
      $friends = User::friends();
      $ownedGroups = User::ownedGroups();
      $ownedRoutes = User::ownedRoutes();
      
      $userdata = array('user' => $user, 
                        'routes' => $routes,
                        'groups' => $groups, 
                        'friends' => $friends,
                        'ownedGroups' => $ownedGroups, 
                        'ownedRoutes' => $ownedRoutes);
      var_dump($userdata);
      */
      return view('pages.dashboard');
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
