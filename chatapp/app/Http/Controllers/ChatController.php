<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function rooms(Request $request)
    {
        return ChatRoom::all();
    }

    public function messages(Request $request, $roomId)
    {
        // return ChatMessage::where('chat_room_id', $roomId)
        //                 ->with('user')->latest()->get();

        // dd(ChatMessage::where('chat_room_id', $roomId)
        // ->with('user')->latest()->paginate(20));
        return ChatMessage::where('chat_room_id', $roomId)
                ->with('user')->latest()->paginate(20);
    }

    public function newMessage(Request $request, $roomId)
    {
        $newMessage = new ChatMessage;
        $newMessage->user_id = Auth::id();
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save();

        broadcast(new NewChatMessage($newMessage))->toOthers();

        return $newMessage;
    }
}
