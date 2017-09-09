<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use Illuminate\Http\Request;
use App\Conversation;

class ConversationController extends Controller
{
    public function store(Request $request)
    {
        $conversation = Conversation::create([
            'message' => $request->input('message'),
            'group_id'=>$request->input('group_id'),
            'user_id'=>$request->input('user_id')
        ]);

        broadcast(new NewMessage($conversation))->toOthers();

        return $conversation->load('user');
    }
}
