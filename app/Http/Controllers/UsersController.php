<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Resources\UsersResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function get(Request $request)
    {
        $id = $request->input('user_id') ?? Auth::user()->id;
        $data = Users::find($id);

    	return new UsersResource($data);
    }
}
