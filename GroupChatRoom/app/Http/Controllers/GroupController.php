<?php
namespace App\Http\Controllers;
use App\Events\GroupCreated;
use App\Group;
use Illuminate\Http\Request;
class GroupController extends Controller
{
    public function store()
    {
        $group = Group::create(['name' => request('name')]);
        $users = collect(request('users')); // 想要加進群組的使用者
        $users->push(auth()->user()->id); // 把自己也加進去
        $group->users()->attach($users); // 使用者附加至群組裡
        broadcast(new GroupCreated($group))->toOthers();
        return $group;
    }
}
