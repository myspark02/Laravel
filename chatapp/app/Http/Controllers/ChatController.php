<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{

    public function index()
    {
        $rooms = ChatRoom::all();
        // dd($rooms[0]);
        return Inertia::render(
            'Chat/container',
            [
                'chatRooms' => $rooms,
                'currentRoom' => $rooms[0],
                'messages' => ChatMessage::where('chat_room_id', $rooms[0]->id)->with('user')->latest()->paginate(3),
                'loginUserId' => auth()->user()->id
            ]
        );
    }

    public function indexV2()
    {
        return Inertia::render(
            'Chat/containerV2',
            [
                'loginUserId' => auth()->user()->id
            ]
        );
    }

    public function rooms(Request $request)
    {
        return ChatRoom::all();
    }

    public function messages(Request $request, $roomId)
    {
        if ($request->wantsJson()) {
            // dd('json');
            return ChatMessage::where('chat_room_id', $roomId)
                ->with('user')->latest()->paginate(3);
        }

        $rooms = ChatRoom::all();
        return Inertia::render(
            'Chat/container',
            [
                'chatRooms' => fn () => $rooms,
                'currentRoom' => fn () => ChatRoom::find($roomId),
                'messages' => fn () => ChatMessage::where('chat_room_id', $roomId)->with('user')->latest()->paginate(3),
                'loginUserId' => auth()->user()->id,
            ]
        );
    }

    public function newMessage(Request $request, $roomId)
    {
        $newMessage = new ChatMessage;
        $newMessage->user_id = Auth::id();
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save();
        $newMessage->user;

        broadcast(new NewChatMessage($newMessage))->toOthers();

        return $newMessage;
    }
}
