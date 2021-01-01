<?php

namespace App\Http\Controllers;

use App\Models\Conversations;
use App\Http\Resources\ConversationsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function getConversations(Request $request)
    {
        $user_id = Auth::user()->id;

        $data = Conversations::where('user_id', $user_id)->pluck('peer_id');;

        return [
            'count' => $data->count(),
            'items' => new ConversationsResource($data)
        ];
    }
}
