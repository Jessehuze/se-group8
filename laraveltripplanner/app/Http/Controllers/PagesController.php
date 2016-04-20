<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function dashboard()
    {
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
