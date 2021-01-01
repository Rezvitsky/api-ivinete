<?php

namespace App\Http\Controllers;

use App\Models\Friends;
use App\Http\Resources\FriendsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
	public function get(Request $request)
	{
		$user_id = $request->user_id ?? Auth::user()->id;
		$data = Friends::where('user_id', $user_id)->pluck('to_id');

		return [
			'count' => $data->count(),
			'items' => new FriendsResource($data)
		];
	}
}
