<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Auth::user()->groups();
        $users = User::where('id','<>',Auth::user()->id)->get();
        $user = Auth::user();
        return view('home',[
            'groups'=>$groups,
            'users'=>$users,
            'user'=>$user
        ]);
    }
}
