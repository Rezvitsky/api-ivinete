<?php

namespace App\Http\Controllers;

use App\Models\Wall;
use App\Models\Users;
use App\Models\Pages;
use App\Http\Resources\WallResource;
use App\Http\Resources\UsersResource;
use App\Http\Resources\PagesResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WallController extends Controller
{
    public function get(Request $request)
    {
        $owner_id = $request->input('owner_id') ?? Auth::user()->id;

        $data = $owner_id == 'all' ? Wall::orderByDesc('id')->get() : Wall::where('owner_id', $owner_id)->orderByDesc('id')->get();

        $from_id = $data->pluck('from_id')->toArray();

        $user_id = array_filter($from_id, function ($v) {
            return $v > 0;
        });
          
        $page_id = array_filter($from_id, function ($v) {
            return $v < 0;
        });

        return [
            'count' => $data->count(),
            'items' => WallResource::collection($data),
            'users' => UsersResource::collection(Users::whereIn('id', $user_id)->get()),
            'pages' => PagesResource::collection(Pages::whereIn('id', array_map('abs', $page_id))->get())
        ];
    }

    public function post(Request $request)
    {

    	$validate = $this->validate($request, [
            'text'     => 'required|string|min:1|max:1024'
        ]);

        $validate['from_id'] = Auth::user()->id;
        $validate['owner_id'] = $request->owner_id ?? Auth::user()->id;

        $data = Wall::create($validate);

    	return [
            'id' => $data->id
        ];
    }
}
