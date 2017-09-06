<?php

namespace App\Http\Controllers;

use App\Events\GroupCreated;
use Illuminate\Http\Request;
use App\Group;
use Auth;

class GroupController extends Controller
{
    public function store(Request $request)
    {
        $group = Group::create(['name'=>$request->input('name')]);
        $users = collect($request->input('users'));
        $users->push(Auth::user()->id);
        $group->users()->attach($users); // 使用者附加至群組
        broadcast(new GroupCreated($group))->toOthers();

        return $group;
    }
}
